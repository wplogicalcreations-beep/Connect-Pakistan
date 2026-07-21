<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Services\JobBoardService;
use Illuminate\Http\Request;
use App\Models\Status;

class JobBoardController extends Controller
{
    protected $jobBoardService;

    public function __construct(JobBoardService $jobBoardService)
    {
        $this->jobBoardService = $jobBoardService;
    }

    private function renderJobBoardRows($jobs, $view = 'super-admin.job-board.single-job-board-row')
    {
        $rows = '';
        $serialNumber = $jobs instanceof \Illuminate\Pagination\LengthAwarePaginator ? $jobs->firstItem() : 1;

        if ($jobs->count() > 0) {
            foreach ($jobs as $index => $job) {
                $rows .= view($view, [
                    'job' => $job,
                    'serialNumber' => $serialNumber + $index
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    public function index(Request $request)
    {
        try {
            $jobsBoard = $this->jobBoardService->getAllJobs($request);

            if ($request->ajax()) {
                $rowsHtml = $this->renderJobBoardRows($jobsBoard);
                $pagination = view('components.pagination', ['items' => $jobsBoard])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $jobsBoard->total(),
                ]);
            }

            return view('super-admin.job-board.index', compact('jobsBoard'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getStatuses()
    {
        $statuses = Status::all(['id', 'name']);

        return response()->json([
            'statuses' => $statuses
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job_posts,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        $job = $this->jobBoardService->update($request);

        $statusName = $job->status->name;
        $badgeClass = match (strtolower($statusName)) {
            'active'   => 'bg-success-2',
            'closed'   => 'bg-danger',
            'pending'  => 'bg-warning text-dark',
            'draft'    => 'bg-secondary',
            default    => 'bg-info',
        };

        return response()->json([
            'success' => true,
            'status_name' => $statusName,
            'status_class' => $badgeClass
        ]);
    }
}