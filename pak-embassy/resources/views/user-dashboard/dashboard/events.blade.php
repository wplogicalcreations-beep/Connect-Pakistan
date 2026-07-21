<!-- Event Section -->
<section class="event-sec">
    <div class="container-fluid">
        <div class="event-top ">
            <div>
                <h5>Upcoming Events in KSA <img src="{{ asset('user-dash-img/Flags.svg') }}" alt="Image" class="img-fluid pe-4"></h5>
                
            </div>
            <a href="{{ route('events.list') }}">View All</a>

        </div>
        <div class="row g-3">
            @forelse ($data['events']->take(3) as $event)
            @include('user-dashboard.event.partials.single-event-card', ['event' => $event])
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
                <h5>Jobs in KSA <img src="{{ asset('user-dash-img/Flags.svg') }}" alt="Image" class="img-fluid pe-4"></h5>
                
            </div>
            <a href="{{route('jobs.list')}}">View All</a>

        </div>
        <div class="row g-3">
            @forelse ($data['job_posts']->take(3) as $job)
            @include('user-dashboard.job-board.partials.single-job-card', ['job' => $job])
            @empty
            <div class="col-12">
                <div class="single-card text-center p-5 shadow-sm rounded">
                    <!-- <img src="{{ asset('images/no-events.png') }}"
                        alt="No Events"
                        class="img-fluid mb-3"
                        style="max-width:150px;"> -->
                    <h4 class="mb-2">No Jobs</h4>
                    <p class="text-muted">Stay tuned! We’ll be posting new jobs soon.</p>
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
            <a href="{{ route('user.events') }}">View All</a>

        </div>
        <div class="row g-3">
            @forelse ($data['user_events']->take(3) as $event)
                @include('user-dashboard.event.partials.single-event-card', ['event' => $event])
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
                        <button class="btn btn-enrol border-0"><a href="{{ url('/user/knowledge-area') }}">View
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
                        <button class="btn btn-enrol border-0"><a href="{{ url('/user/knowledge-area') }}">View
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
                        <button class="btn btn-enrol border-0"><a href="{{ url('/user/knowledge-area') }}">View
                                Event</a></button>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <div class="container-fluid">
        <div class="event-top mt-3">
            <div>
                <h5>Job Applications</h5>
            </div>
        </div>
    <div class="card border-0 pb-3 px-2">
        <div class="row">
            @include('user-dashboard.job-application.__filters', ['jobApplications' => $data['jobApplications']])

            @include('user-dashboard.job-application.__table',['jobApplications' => $data['jobApplications']])
        </div>
    </div>
    </div>
</section>