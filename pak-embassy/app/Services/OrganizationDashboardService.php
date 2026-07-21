<?php

namespace App\Services;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class OrganizationDashboardService extends BaseDashboardService
{

    public function dashboardData($request): array
    {
        $user = auth()->user();
        $events = $this->eventService->events($request);
        $past_events = $this->eventService->userPastEvents($user);
        $upcoming_events = $this->eventService->upcomingEvents($user);
        $booking = $user->latestActiveBookingRequest;
        // dd($booking);


        return [
            'events' => $events,
            'user_events' => $past_events,
            'upcomingEvents' => $upcoming_events,
            'booking' => $booking
        ];
    }

    public function jobPosts($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';

        $user = auth()->user();
        $jobPosts = $user->jobPosts()
            ->with('status')
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
        return $jobPosts;

        // return JobPost::applyFilter($request)
        //     ->orderBy($sortBy, $sortOrder)
        //     ->paginate($records)
        //     ->withQueryString();
    }

    public function jobApplications($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';
        $user = auth()->user();
        $job_applications = $user->receivedApplications()
            ->with(['user', 'jobPost', 'details'])
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString(); // use method not property

        return $job_applications;
    }
}
