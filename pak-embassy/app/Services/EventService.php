<?php

namespace App\Services;

use App\Models\Event;
use App\Models\User;

class EventService{

    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function events($request)
    {
        $records = $request->per_page ?? 9;
        $sortBy = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';

        return Event::applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    public function userEnrollments($user, $request)
    {
        $userEvents = $user->events();

        $records = $request->per_page ?? 9;
        $sortBy = $request->sort_by ?? 'events.created_at';
        $sortOrder = $request->sort_order ?? 'desc';

        return $userEvents->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    public function userPastEvents($user)
    {
        $pastEvents =  $user->events()
        ->where('end_date', '<', now())
        ->orderBy('end_date', 'desc')
        ->get();
        return $pastEvents;
    }

    public function upcomingEvents($request)
    {
        $upcomingEvents = Event::ofType('public')
            ->where('end_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();
        return $upcomingEvents;
    }

    public function eventDetails($request)
    {
        $event = Event::find($request->event_id);
        return $event;
    }

    public function eventEnrollment($request)
    {
        $user = auth()->user();
        // Attach the event (create enrollment)
        $user->events()->syncWithoutDetaching([$request->event_id]);
        return true;

    }

    public function attendedEvents($request, $user)
    {
        $records = $request->per_page ?? 30;
        $sortBy = $request->sort_by ?? 'end_date';
        $sortOrder = $request->sort_order ?? 'desc';

        // Use the attendedEvents relationship from User model
        $events = $user->attendedEvents()
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();

        return $events;
    }

}
