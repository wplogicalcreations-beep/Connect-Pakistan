<?php

namespace App\Services;

use App\Models\User;
use App\Services\CoworkingSpaceService;
use App\Services\EventService;
use App\Services\JobApplicationService;
use App\Services\JobPostService;
use App\Services\UserService;
use Illuminate\Container\Attributes\Auth;

abstract class BaseDashboardService
{

    protected $userService;
    protected $eventService;
    protected $jobService;
    protected $jobApplicationService;
    protected $coworkingSpaceService;
    public function __construct(UserService $userService, EventService $eventService, JobPostService $jobService, JobApplicationService $jobApplicationService, CoworkingSpaceService $coworkingSpaceService)
    {
        $this->userService = $userService;
        $this->eventService = $eventService;
        $this->jobService = $jobService;
        $this->jobApplicationService = $jobApplicationService;
        $this->coworkingSpaceService = $coworkingSpaceService;
    }

    abstract public function dashboardData($request): array;

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
        $events = $this->eventService->userEnrollments($user, $request);
        return $events;
    }

    public function coworkingSpaces($request)
    {
         $coworkingSpaces = $this->coworkingSpaceService->listing($request);
         return $coworkingSpaces;
    }
}
