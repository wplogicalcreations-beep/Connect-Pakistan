<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $logs = $this->getLogs();
        
        if ($request->ajax()) {
            return response()->json([
                'logs' => $logs,
                'totalCount' => count($logs),
            ]);
        }

        return view('logs.index', compact('logs'));
    }

    public function getLogs()
    {
        $logFile = storage_path('logs/laravel.log');
        
        if (!File::exists($logFile)) {
            return [];
        }

        $logs = [];
        $fileContent = File::get($logFile);
        
        // Split by lines
        $lines = explode("\n", $fileContent);
        
        $currentEntry = null;
        $currentMessage = '';
        
        // Process from end to get latest logs first
        for ($i = count($lines) - 1; $i >= 0; $i--) {
            $line = $lines[$i];
            
            // Check if line starts with a date (Laravel log format: [2025-12-07 19:54:19])
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2})\s+(\d{2}:\d{2}:\d{2})\]\s+local\.(ERROR|WARNING|INFO|DEBUG|CRITICAL|ALERT|EMERGENCY):\s*(.+)$/', $line, $matches)) {
                $date = $matches[1];
                $time = $matches[2];
                $level = strtolower($matches[3]);
                $message = $matches[4];
                
                $logDate = Carbon::parse($date);
                
                // Only get logs from today
                if ($logDate->isToday()) {
                    // Save previous entry if exists
                    if ($currentEntry !== null) {
                        $logs[] = $currentEntry;
                    }
                    
                    // Start new entry
                    $currentEntry = [
                        'date' => $date,
                        'time' => $time,
                        'level' => $level,
                        'message' => $message,
                        'header' => $this->getLogHeader($level, $message),
                        'description' => $this->getLogDescription($message),
                        'timestamp' => $date . ' ' . $time,
                        'formatted_date' => Carbon::parse($date)->format('d-M-Y'),
                    ];
                    $currentMessage = $message;
                } else {
                    // Stop if we've gone past today
                    if ($logDate->isPast() && !$logDate->isToday()) {
                        break;
                    }
                }
            } elseif ($currentEntry !== null && !empty(trim($line)) && !preg_match('/^\[/', $line)) {
                // Continuation of previous log entry (stack trace, etc.)
                $currentEntry['message'] = $line . "\n" . $currentEntry['message'];
            }
        }
        
        // Add the last entry
        if ($currentEntry !== null) {
            $logs[] = $currentEntry;
        }
        
        // Limit to 20 most recent
        return array_slice($logs, 0, 20);
    }

    public function getUnreadCount()
    {
        $logs = $this->getLogs();
        // Count all logs from today
        $totalCount = count($logs);
        
        return response()->json(['count' => $totalCount]);
    }

    private function getLogHeader($level, $message)
    {
        // Extract meaningful header from message
        // Try to get the first part before any JSON or stack trace
        $header = $message;
        
        // If message contains JSON, extract the action/event name
        if (preg_match('/^([^\{]+)/', $message, $matches)) {
            $header = trim($matches[1]);
        }
        
        // Capitalize first letter and limit length
        $header = ucfirst($header);
        if (strlen($header) > 70) {
            $header = substr($header, 0, 67) . '...';
        }
        
        return $header ?: ucfirst($level) . ' Log Entry';
    }

    private function getLogDescription($message)
    {
        // Get description - truncate message for display
        $description = $message;
        
        // Remove JSON data if present for cleaner display
        if (preg_match('/^([^\{]+)/', $message, $matches)) {
            $description = trim($matches[1]);
        }
        
        // Limit length
        if (strlen($description) > 95) {
            $description = substr($description, 0, 92) . '...';
        }
        
        return $description ?: 'Log entry';
    }
}
