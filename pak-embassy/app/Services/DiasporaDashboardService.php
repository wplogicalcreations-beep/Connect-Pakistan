<?php

namespace App\Services;

use App\Models\Status;
use App\Models\User;

class DiasporaDashboardService extends BaseDashboardService
{

    public function dashboardData($request): array
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

    public function jobsListing($request)
    {
        $jobs = $this->jobService->activeJobs($request);
        return $jobs;
    }
}