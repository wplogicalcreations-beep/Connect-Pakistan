<!-- Event Section -->
<section class="event-sec">
    <div class="container-fluid">
        <div class="event-top ">
            <div>
                <h5>Upcoming Events in KSA
                <img src="{{ asset('user-dash-img/Flags.svg') }}" alt="Image" class="img-fluid pe-4"></h5>
            </div>
            <a href="">View All</a>

        </div>
        <div class="row g-3">
            @forelse ($data['events']->take(3) as $event)
            @include('company-dashboard.event.partials.single-event-card', ['event' => $event])
            @empty
            <div class="col-12">
                <div class="single-card text-center p-5 shadow-sm rounded">
                    <!-- <img src="{{ asset('images/no-events.png') }}"
                        alt="No Events"
                        class="img-fluid mb-3"
                        style="max-width:150px;"> -->
                    <h4 class="mb-2">No Upcoming Events</h4>
                    <p class="text-muted">Stay tuned! We’ll be announcing new events soon.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>


<section class="event-sec">
    <div class="container-fluid">
        <div class="event-top ">
            <div>
                <h5>Your Past Events in KSA
                <img src="{{ asset('user-dash-img/Flags.svg') }}" alt="Image" class="img-fluid pe-4"></h5>
            </div>
            <a href="">View All</a>

        </div>
        <div class="row g-3">
            @forelse ($data['user_events']->take(3) as $event)
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
</section>
@if(isset($data['booking']) && $data['booking'])
    <section class="event-sec" 
        data-start="{{ \Carbon\Carbon::parse($data['booking']->estimated_start_date)->format('Y-m-d') }}"
        data-end="{{ \Carbon\Carbon::parse($data['booking']->end_date)->format('Y-m-d') }}">

        <div class="container-fluid">
            <div class="event-top">
                <div>
                    <h5>Co-Working Space (Duration)</h5>
                </div>
            </div>

            <div class="progress my-3 position-relative">
                <div id="durationProgress" class="progress-bar bg-success text-white" style="width: 0%;"></div>
                <span id="daysRemaining" class="position-absolute remaining-text"></span>
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <div class="date-label">Start Date</div>
                    <div id="startDateLabel" class="fw-semibold">
                        {{ \Carbon\Carbon::parse($data['booking']->estimated_start_date)->format('m/d/Y') }}
                    </div>
                </div>
                <div class="text-end">
                    <div class="date-label">End Date</div>
                    <div id="endDateLabel" class="fw-semibold">
                        {{ \Carbon\Carbon::parse($data['booking']->end_date)->format('m/d/Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <div class="text-center py-4">
        <h5>No coworking spaces available at the moment.</h5>
    </div>
@endif




<!-- Knowledge Section -->
<section class="event-sec">
    <div class="container-fluid">
        <div class="event-top ">
            <div>
                <h5>Knowledge Area</h5>
            </div>
            <a href="">View All</a>

        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                <div class="single-card">
                    <img src="{{ asset('user-dash-img/area-one.png') }}" alt="Image" class="img-fluid w-100">
                    <div class="card-txt">
                        <h4>Fintech Revolution Summit 2025</h4>
                        <p>Join industry leaders in Riyadh to explore cutting-edge fintech innovations shaping
                            the future of Saudi Arabia's digital economy.</p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-enrol border-0"><a href="{{ url('/company/knowledge-area') }}">View
                                Event</a></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                <div class="single-card">
                    <img src="{{ asset('user-dash-img/area-two.png') }}" alt="Image" class="img-fluid w-100">
                    <div class="card-txt">
                        <h4>eCommerce Expo KSA 2025</h4>
                        <p>Discover the latest in eCommerce trends, technologies, and strategies transforming
                            Saudi Arabia's digital marketplace.</p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-enrol border-0"><a href="{{ url('/company/knowledge-area') }}">View
                                Event</a></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                <div class="single-card">
                    <img src="{{ asset('user-dash-img/area-three.png') }}" alt="Image" class="img-fluid w-100">
                    <div class="card-txt">
                        <h4>Startup & Incubation KSA 2025</h4>
                        <p>Connect with visionary entrepreneurs, tech innovators, and investors shaping the
                            future of startups and incubators in Saudi Arabia.</p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-enrol border-0"><a href="{{ url('/company/knowledge-area') }}">View
                                Event</a></button>
                    </div>
                </div>
            </div>



        </div>
    </div>
</section>