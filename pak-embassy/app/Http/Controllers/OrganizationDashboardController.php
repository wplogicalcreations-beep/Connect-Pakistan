<?php

namespace App\Http\Controllers;

use App\Models\CoworkingSpace;
use App\Models\Event;
use App\Models\JobPost;
use App\Models\Lov;
use App\Models\LovType;
use App\Services\Organization\DashboardService;
use App\Services\OrganizationDashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class OrganizationDashboardController extends Controller
{
    private $dashboardService;

    public function __construct(OrganizationDashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        $data = $this->dashboardService->dashboardData($request);
        return view('company-dashboard.dashboard.index', compact('data'));
    }

    public function companydiscoverJob(Request $request)
    {
        $jobs = $this->dashboardService->jobPosts($request);
        $domains = Lov::ofType(LovType::WORK_DOMAIN)->get();
        $jobPosts = JobPost::JOB_TYPES;
        if ($request->ajax()) {
            return response()->json([
                'html' => view('company-dashboard.job-board.partials.jobs_list', compact('jobs'))->render(),
                'hasMorePages' => $jobs->hasMorePages()
            ]);
        }
        return view('company-dashboard.job-board.discover-job', compact('jobs','domains','jobPosts'));
    }

    public function companydetailJob(JobPost $job, Request $request)
    {
        try {
            return view('company-dashboard.job-board.job-detail', compact('job'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function companypublicEvent(Request $request)
    {
        try {
            $events = $this->dashboardService->eventsListing($request);
            if ($request->ajax()) {
                return response()->json([
                    'html' => view('company-dashboard.event.partials.events_list', compact('events'))->render(),
                    'hasMorePages' => $events->hasMorePages()
                ]);
            }
            return view('company-dashboard.event.public-event', compact('events'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function companyEvents(Request $request)
    {
        try {
            $events = $this->dashboardService->userEvents($request);
            if ($request->ajax()) {
                return response()->json([
                    'html' => view('company-dashboard.event.partials.events_list', compact('events'))->render(),
                    'hasMorePages' => $events->hasMorePages()
                ]);
            }
            return view('company-dashboard.event.public-event', compact('events'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function detailJob(JobPost $job)
    {
        return view('user-dashboard.job-board.job-detail', compact('job'));
    }

    public function companyeventDetail(Event $event)
    {
        try {
            $event->load('attendees.user');
            $relatedEvents = Event::latest()->limit(3)->get();
            return view('company-dashboard.event.event-detail', compact('event','relatedEvents'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    function renderJobApplicationsRows($applications, $view)
    {
        $rows = '';

        if($applications->count() > 0)
        {
            foreach ($applications as $index => $application) {
                $rows .= view($view, [
                    'application' => $application,
                ])->render();
            }
        }
        else{
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    public function companyworkSpace(Request $request)
    {
        $coworkingSpaces = $this->dashboardService->coworkingSpaces($request);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('company-dashboard.work-space.partials.single-coworking-space', compact('coworkingSpaces'))->render(),
                'hasMorePages' => $coworkingSpaces->hasMorePages()
            ]);
        }
        return view('company-dashboard.work-space.co-work-space', compact('coworkingSpaces'));
    }

    public function companyworkSpaceDetail(CoworkingSpace $space)
    {
        try {
             $coworkingSpaces = CoworkingSpace::latest()->limit(3)->get();
            return view('company-dashboard.work-space.work-space-detail', compact('space','coworkingSpaces'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function recieved_applications(Request $request)
    {
        try {
            $applications = $this->dashboardService->jobApplications($request);
            if ($request->ajax()) {
                $rows = '';
                $rowsHtml = $this->renderJobApplicationsRows($applications, 'company-dashboard.job-applications.single-job-applied-row');
                $pagination = view('components.pagination', ['items' => $applications])->render();
                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination
                ]);
            }
            return view('company-dashboard.job-applications.index', compact('applications'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }
}
