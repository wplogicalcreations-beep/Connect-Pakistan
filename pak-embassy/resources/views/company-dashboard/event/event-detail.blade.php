@extends('dashboard-layouts.company-layout.master')

@section('content')
<div class="event-top mt-4 mb-3">
    <a href="{{ url('/company/public-event')}}"><img src="{{ asset('user-dash-img/ph_arrow-left-bold.svg')}}" alt="ph_arrow-left-bold image">Go Back</a>
</div>
<div class="row g-4 text-style border-bottom">
    <!-- Left Column -->
    <div class="col-lg-7">
        <h2>{{$event->name}}</h2>
        <p>{{$event->description}}</p>
        <div class="mb-3">
            @if(isUserEnrolledInEvent(auth()->user(), $event))
            <button class="btn btn-secondary enrolled-btn" disabled>Enrolled</button>
            @else
            <a href="javascript:void(0)"
                data-url="{{ route('user.enroll') }}"
                data-event-id="{{ $event->id }}"
                class="btn btn-outline-success btn-enrol mt-auto enroll-btn">
                Enroll Now →
            </a>
            <button class="btn btn-outline-secondary not-interested-btn">Not Interested</button>
            <button class="btn btn-secondary enrolled-btn d-none" disabled>Enrolled</button>
            @endif

        </div>

        <h4 class="section-title">Event Overview</h4>
        {!!$event->event_overview!!}

        <h4 class="section-title">Agenda</h4>

        {!!$event->event_agenda!!}

        <h4 class="section-title">Event Format</h4>
        {!!$event->event_format!!}
        <h4 class="section-title">Who's Attending?</h4>
        <ul>
            @forelse($event->attendees as $attendee)
            <li>
                @if($attendee->user)
                    {{ $attendee->user->name }}
                @else
                    N/A
                @endif
            </li>
            @empty
            <li>No attendees listed yet.</li>
            @endforelse
        </ul>

        @php
            $isAttendee = $event->attendees->contains('user_id', auth()->id());
            $hasMoM = !empty($event->event_mom_detail);
            $eventEnded = $event->end_date && \Carbon\Carbon::parse($event->end_date . ' ' . $event->end_time)->isPast();
        @endphp

        @if($isAttendee && $hasMoM && $eventEnded)
        <h4 class="section-title mt-4">Minutes of Meeting</h4>
        <div class="card border-0 p-3 bg-light">
            <div class="mb-3">
                <p class="text-muted small mb-2">
                    <i class="bi bi-file-text me-2"></i>
                    Minutes of Meeting for this event
                </p>
            </div>
            <div class="event-mom-content">
                {!! $event->event_mom_detail !!}
            </div>
        </div>
        @elseif($isAttendee && $eventEnded && !$hasMoM)
        <h4 class="section-title mt-4">Minutes of Meeting</h4>
        <div class="card border-0 p-3 bg-light">
            <p class="text-muted mb-0">
                <i class="bi bi-info-circle me-2"></i>
                Minutes of Meeting will be available soon.
            </p>
        </div>
        @endif
    </div>

    <!-- Right Column: Event Card -->
    <div class="col-lg-5">
        <div class="event-card border-0 p-0 background-unset">
            @if(!empty($event->images) && count($event->images) > 0)
            <img src="{{ asset('storage/' . $event->images[0]->path) }}"
                alt="Event Image"
                class="img-fluid w-100"
                style="object-fit: cover; height: 200px;">
            @else
            <img src="{{ asset('user-dash-img/event-date.svg') }}"
                alt="Default Event Image"
                class="img-fluid w-100 d-block mx-auto"
                style="object-fit: contain; height: 200px; background:#f8f9fa;">
            @endif
            <!-- Date and Time Section -->
            <div class="my-4">
                <h6 class="text-muted fw-bold mb-2">Date and Time</h6>
                <p class="mb-1"><img class="pe-2" width="20" height="20" src="{{ asset('user-dash-img/event-date.svg')}}"
                        alt="calender Image">{{ $event->start_date}}</p>
                <p class="mb-1"><img class="pe-2" width="20" height="20" src="{{ asset('user-dash-img/event-time.svg')}}"
                        alt="time icon">{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }} -
                    {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}

                    <span class="text-muted">
                        ({{ eventDuration($event->start_time, $event->end_time) }} Duration)
                    </span>
                </p>
                <p class="mb-3"><img class="pe-2" width="20" height="20" src="{{ asset('user-dash-img/event-note.svg')}}"
                        alt="event-icon">{{$event->event_type}}</p>
            </div>

            <!-- Location -->
            <h6 class="text-muted fw-bold mb-2">Location</h6>
            @if($event->event_mode === 'virtual')
            <p>
                <i class="bi bi-link-45deg me-2 text-primary"></i>
                <a href="{{ $event->meeting_link }}" target="_blank" class="text-decoration-none text-dark">
                    Join Meeting
                </a>
            </p>
            @else
            <p>
                <i class="bi bi-geo-alt-fill me-2 text-success"></i>
                <a href="https://www.google.com/maps/place/Al+Badeiah,+Riyadh+Saudi+Arabia" target="_blank"
                    class="text-decoration-none text-dark">
                    {{$event->location}}
                </a>
            </p>

            <!-- Embedded Google Map -->
            <div class="ratio ratio-4x3 rounded overflow-hidden">
                <iframe
                    src="{{$event->embed_map_url}}"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            @endif

        </div>
    </div>
</div>
<div class="row mt-5 event-sec">
    <div class="event-top mb-3">
        <div>
            <h5>Other events you may like</h5>
        </div>

    </div>
    <div class="row g-3">
        @forelse ($relatedEvents as $event)
        @include('company-dashboard.event.partials.single-event-card', ['event' => $event])
        @empty
        <div class="col-12">
            <div class="single-card text-center p-5 shadow-sm rounded">
                <h4 class="mb-2">No Past Events Found</h4>
                <p class="text-muted">You haven’t attended any events in KSA yet.
                    <br>Check out upcoming opportunities and join the community!
                </p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
@section('js-file')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/event.js') }}"></script>
@endsection