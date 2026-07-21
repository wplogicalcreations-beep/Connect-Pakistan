<?php

namespace App\Services\Diaspora;

use App\Models\User;
use App\Services\CoworkingSpaceService;
use App\Services\EventService;
use App\Services\JobApplicationService;
use App\Services\JobPostService;
use App\Services\UserService;
use Illuminate\Container\Attributes\Auth;

class DashboardService
{

    private $userService;
    private $eventService;
    private $jobService;
    private $jobApplicationService;
    private $coworkingSpaceService;
    public function __construct(UserService $userService, EventService $eventService, JobPostService $jobService, JobApplicationService $jobApplicationService, CoworkingSpaceService $coworkingSpaceService)
    {
        $this->userService = $userService;
        $this->eventService = $eventService;
        $this->jobService = $jobService;
        $this->jobApplicationService = $jobApplicationService;
        $this->coworkingSpaceService = $coworkingSpaceService;
    }

    public function dashboardData($request)
    {
        $user = auth()->user();
        $events = $this->eventService->events($request);
        $past_events = $this->eventService->userPastEvents($user);
        $upcoming_events = $this->eventService->upcomingEvents($user);
        $jobs = $this->jobService->job_posts($request);
        $jobApplications = $this->userJobApplications($request);

        return [
            'events' => $events,
            'user_events' => $past_events,
            'job_posts' => $jobs,
            'upcomingEvents' => $upcoming_events,
            'jobApplications' => $jobApplications
        ];
    }

    public function jobsListing($request)
    {
        $jobs = $this->jobService->job_posts($request);
        return $jobs;
    }

    public function jobDetails($id)
    {
        $jobDetails = $this->jobService->jobDetails($id);
        return $jobDetails;
    }

    public function eventsListing($request)
    {
        $events = $this->eventService->events($request);
        return $events;
    }

    public function userEvents($request)
    {
        $user = auth()->user();
        $events = $this->eventService->userEnrollments($user);
        return $events;
    }

    public function userJobApplications($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';
        $user = auth()->user();
        $job_applications = $user->jobApplications()
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString(); // use method not property

        return $job_applications;
    }

    public function coworkingSpaces($request)
    {
         $coworkingSpaces = $this->coworkingSpaceService->listing($request);
         return $coworkingSpaces;
    }
}
