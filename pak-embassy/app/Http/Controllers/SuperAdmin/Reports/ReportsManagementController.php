<?php

namespace App\Http\Controllers\SuperAdmin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SuperAdmin\Reports\ReportsManagementService;

class ReportsManagementController extends Controller
{
    protected $reportsService;

    public function __construct(ReportsManagementService $reportsService)
    {
        $this->reportsService = $reportsService;
    }

    public function usersReport(Request $request)
    {
         try {
            $data = $this->reportsService->getUsersAndOrganizations($request);

            if ($request->ajax()) {
                $rows = '';
                $rowsHtml = render_rows($data, 'super-admin.reports.users.single-user-row', 'user');
                $pagination = view('components.pagination', ['items' => $data])->render();
                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination
                ]);
            }
            // Normal page load
            return view('super-admin.reports.users.index', compact('data'));
        
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function jobsReport(Request $request)
    {
        try {
            $data = $this->reportsService->getJobPosts($request);
            if ($request->ajax()) {
                $rows = '';
                $rowsHtml = render_rows($data, 'super-admin.reports.jobs.single-job-row', 'job');
                $pagination = view('components.pagination', ['items' => $data])->render();
                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination
                ]);
            }

            return view('super-admin.reports.jobs.index', compact('data'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function eventsReport(Request $request)
    {
        try {
            $data = $this->reportsService->getEvents($request);

            if ($request->ajax()) {
                $rows = '';
                $rowsHtml = render_rows($data, 'super-admin.reports.events.single-event-row', 'event');
                $pagination = view('components.pagination', ['items' => $data])->render();
                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination
                ]);
            }

            return view('super-admin.reports.events.index', compact('data'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function coWorkingSpaceReport(Request $request)
    {
        try {
            $data = $this->reportsService->getCoWorkingSpaces($request);

            if ($request->ajax()) {
                $rows = '';
                $rowsHtml = render_rows($data, 'super-admin.reports.coworking.single-space', 'space');
                $pagination = view('components.pagination', ['items' => $data])->render();
                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination
                ]);
            }

            return view('super-admin.reports.coworking.index', compact('data'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function matchMakingReport(Request $request)
    {
        try {
            $data = $this->reportsService->getMatchMakingReport($request);
              if ($request->ajax()) {
                $rows = '';
                $rowsHtml = render_rows($data, 'super-admin.reports.match-making.single-match-making-row', 'match');
                $pagination = view('components.pagination', ['items' => $data])->render();
                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination
                ]);
            }

            return view('super-admin.reports.match-making.index', compact('data'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}