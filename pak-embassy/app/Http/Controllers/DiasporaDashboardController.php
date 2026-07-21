<?php

namespace App\Http\Controllers;

use App\Models\CoworkingSpace;
use App\Models\Event;
use App\Models\JobPost;
use App\Models\Lov;
use App\Models\LovType;
use App\Services\Diaspora\DashboardService;
use App\Services\DiasporaDashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class DiasporaDashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DiasporaDashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        $data = $this->dashboardService->dashboardData($request);
        return view('user-dashboard.dashboard.index', compact('data'));
    }

    public function discoverJob(Request $request)
    {
        $jobs = $this->dashboardService->jobsListing($request);
        $domains = Lov::ofType(LovType::WORK_DOMAIN)->get();
        $jobPosts = JobPost::JOB_TYPES;

        if ($request->ajax()) {
            return response()->json([
                'html' => view('user-dashboard.job-board.partials.jobs_list', compact('jobs'))->render(),
                'hasMorePages' => $jobs->hasMorePages()
            ]);
        }
        return view('user-dashboard.job-board.discover-job', compact('jobs','domains','jobPosts'));
    }

    public function jobDetails($request)
    {
        $jobDetails = $this->dashboardService->jobDetails($request);
        return view('user-dashboard.job-board.discover-job', compact('jobs'));
    }

    public function eventsListing(Request $request)
    {
        $events = $this->dashboardService->eventsListing($request);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('user-dashboard.event.partials.events_list', compact('events'))->render(),
                'hasMorePages' => $events->hasMorePages()
            ]);
        }
        return view('user-dashboard.event.public-event', compact('events'));
    }

    public function userEvents(Request $request)
    {
        $events = $this->dashboardService->userEvents($request);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('user-dashboard.event.partials.events_list', compact('events'))->render(),
                'hasMorePages' => $events->hasMorePages()
            ]);
        }
        return view('user-dashboard.event.public-event', compact('events'));
    }

    public function detailJob(JobPost $job)
    {
        try {
            $relatedJobs = JobPost::latest()->limit(3)->get();
            return view('user-dashboard.job-board.job-detail', compact('job', 'relatedJobs'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function eventDetail(Event $event)
    {
        try {
            $event->load('attendees.user');
            $relatedEvents = Event::latest()->limit(3)->get();
            return view('user-dashboard.event.event-detail', compact('event','relatedEvents'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function userJobApplications(Request $request)
    {
        try {
            $jobApplications =  $this->dashboardService->userJobApplications($request);

            if ($request->ajax()) {
                $rows = '';
                $rowsHtml = $this->renderJobApplicationsRows($jobApplications, 'user-dashboard.job-application.single-job-application-row');
                $pagination = view('components.pagination', ['items' => $jobApplications])->render();
                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination
                ]);
            }


            // Normal page load
            return view('user-dashboard.job-application.index', compact('jobApplications'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    function renderJobApplicationsRows($jobApplications, $view)
    {
        $rows = '';
        $serialNumber = $jobApplications instanceof \Illuminate\Pagination\LengthAwarePaginator ? $jobApplications->firstItem() : 1;

        if ($jobApplications->count() > 0) {
            foreach ($jobApplications as $index => $job_application) {
                $rows .= view($view, [
                    'jobApplication' => $job_application,
                    'serialNumber' => $serialNumber + $index,
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    public function workSpace(Request $request)
    {
        $coworkingSpaces = $this->dashboardService->coworkingSpaces($request);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('user-dashboard.work-space.partials.single-coworking-space', compact('coworkingSpaces'))->render(),
                'hasMorePages' => $coworkingSpaces->hasMorePages()
            ]);
        }
        return view('user-dashboard.work-space.co-work-space', compact('coworkingSpaces'));
    }

    public function workSpaceDetail(CoworkingSpace $space)
    {
        try {
            $coworkingSpaces = CoworkingSpace::latest()->limit(3)->get();
            return view('user-dashboard.work-space.work-space-detail', compact('space','coworkingSpaces'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }
}
