<?php

namespace App\Services;

use App\Models\ActionItem;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActionItemService
{
    /**
     * Get all action items for an event
     */
    public function getActionItemsByEvent($eventId, Request $request = null)
    {
        $query = ActionItem::where('event_id', $eventId)
            ->with(['assignedUser:id,name,email', 'event:id,name'])
            ->orderBy('created_at', 'desc');

        if ($request && $request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query->get();
    }

    /**
     * Store a new action item
     */
    public function store(array $data)
    {
        try {
            $actionItem = ActionItem::create([
                'event_id' => $data['event_id'],
                'action' => $data['action'],
                'description' => $data['description'] ?? null,
                'assigned_to' => $data['assigned_to'] ?? null,
                'due_date' => $data['due_date'] ?? null,
                'status' => $data['status'] ?? 'pending',
                'comment' => $data['comment'] ?? null,
            ]);

            return $actionItem->load('assignedUser');
        } catch (\Exception $e) {
            Log::error('Failed to create action item: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an action item
     */
    public function update(ActionItem $actionItem, array $data)
    {
        try {
            $actionItem->update([
                'action' => $data['action'] ?? $actionItem->action,
                'description' => $data['description'] ?? $actionItem->description,
                'assigned_to' => $data['assigned_to'] ?? $actionItem->assigned_to,
                'due_date' => $data['due_date'] ?? $actionItem->due_date,
                'status' => $data['status'] ?? $actionItem->status,
                'comment' => $data['comment'] ?? $actionItem->comment,
            ]);

            return $actionItem->fresh()->load('assignedUser');
        } catch (\Exception $e) {
            Log::error('Failed to update action item: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete an action item
     */
    public function delete(ActionItem $actionItem)
    {
        try {
            $actionItem->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to delete action item: ' . $e->getMessage());
            throw $e;
        }
    }
}

