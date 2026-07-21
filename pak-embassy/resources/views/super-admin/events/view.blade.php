@extends("layouts.master")
@section('content')
<div class="event-top mt-4 mb-3">
    <h3 class="go-back" style="cursor: pointer;" onclick="window.history.back();">
        <img src="{{ asset('user-dash-img/ph_arrow-left-bold.svg')}}" alt="ph_arrow-left-bold image">
        Go Back
    </h3>
</div>
<div class="row g-4 text-style border-bottom">
    <!-- Left Column -->
    <div class="col-lg-7">
        <h2>{{$event->name}}</h2>
        <p>{{$event->description}}</p>

        <h4 class="section-title">Event Overview</h4>
        {!!$event->event_overview!!}

        <h4 class="section-title">Agenda</h4>

        {!!$event->event_agenda!!}

        <h4 class="section-title">Event Format</h4>
        {!!$event->event_format!!}
        <h4 class="section-title">Who's Attending?</h4>
        <ul>
            @foreach($event->attendees as $attendee)
            <li>
                @if($attendee->user)
                    {{ $attendee->user->name }}
                @else
                    N/A
                @endif
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Right Column: Event Card -->
    <div class="col-lg-5">
        <h6 class="text-muted fw-bold mb-2">Event Image</h6>
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
@endsection
