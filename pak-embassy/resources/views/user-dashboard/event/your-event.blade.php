@extends('dashboard-layouts.user-layout.master')

@section('content')
    <div class="row mt-5 g-2 justify-content-end">
        <!-- Filter + Search Input -->
        <div class="col-12 col-md-6 col-lg-7">
            <div class="input-group drop-buttons">
                <button class="btn btn-outline-secondary dropdown-toggle filter-button" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('user-dash-img/filter-icon.svg') }}" alt="Filter Icon"> Filters
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                <input 
                    type="text" 
                    class="form-control search-input" 
                    name="name" 
                    value="{{ request('name') }}" 
                    placeholder="Search"
                    aria-label="Search input with dropdown button">
            </div>
        </div>

        <!-- Location Input -->
        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <input 
                type="text" 
                class="form-control bg-location-icon" 
                name="location" 
                value="{{ request('location') }}" 
                placeholder="Location">
        </div>

    <!-- Date Input -->
    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
        <input 
            type="text" 
            class="form-control bg-date-single" 
            name="start_date" 
            id="date" 
            value="{{ request('start_date') }}" 
            placeholder="Date">
    </div>

    <!-- Search Button -->
    <div class="col-12 col-sm-6 col-md-3 col-lg-1 d-grid">
        <button type="submit" class="btn btn-common-bg w-100">Search</button>
    </div>
</div>

    <!-- Event Section -->
    <section class="event-sec">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/fintech-1.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>Fintech Revolution Summit 2025</h4>
                            <p>Join industry leaders in Riyadh to explore cutting-edge fintech innovations shaping
                                the future of Saudi Arabia's digital economy.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Enroll Now -></a></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/commerce-expo.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>eCommerce Expo KSA 2025</h4>
                            <p>Discover the latest in eCommerce trends, technologies, and strategies transforming
                                Saudi Arabia's digital marketplace.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Access Now -></a></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/startup-ksa.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>Startup & Incubation KSA 2025</h4>
                            <p>Connect with visionary entrepreneurs, tech innovators, and investors shaping the
                                future of startups and incubators in Saudi Arabia.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Enroll Now -></a></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/fintech-1.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>Fintech Revolution Summit 2025</h4>
                            <p>Join industry leaders in Riyadh to explore cutting-edge fintech innovations shaping
                                the future of Saudi Arabia's digital economy.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Enroll Now -></a></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/commerce-expo.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>eCommerce Expo KSA 2025</h4>
                            <p>Discover the latest in eCommerce trends, technologies, and strategies transforming
                                Saudi Arabia's digital marketplace.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Access Now -></a></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/startup-ksa.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>Startup & Incubation KSA 2025</h4>
                            <p>Connect with visionary entrepreneurs, tech innovators, and investors shaping the
                                future of startups and incubators in Saudi Arabia.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Enroll Now -></a></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/fintech-1.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>Fintech Revolution Summit 2025</h4>
                            <p>Join industry leaders in Riyadh to explore cutting-edge fintech innovations shaping
                                the future of Saudi Arabia's digital economy.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Enroll Now -></a></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/commerce-expo.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>eCommerce Expo KSA 2025</h4>
                            <p>Discover the latest in eCommerce trends, technologies, and strategies transforming
                                Saudi Arabia's digital marketplace.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Access Now -></a></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-sm-12 mb-2">
                    <div class="single-card">
                        <img src="{{ asset('user-dash-img/startup-ksa.png')}}" alt="Image" class="img-fluid w-100">
                        <div class="card-txt">
                            <h4>Startup & Incubation KSA 2025</h4>
                            <p>Connect with visionary entrepreneurs, tech innovators, and investors shaping the
                                future of startups and incubators in Saudi Arabia.</p>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-date.svg')}}" alt="calender Image">May 20th, 2025</p>
                                <p class="mb-1"><img class="pe-2" width="20" height="20"
                                        src="{{ asset('user-dash-img/event-note.svg')}}" alt="event-icon">Public Event</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-enrol"><a class="text-decoration-none"
                                    href="{{ url('/user/event-detail')}}">Enroll Now -></a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-common-bg"><a href="">Load More</a></button>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js-file')
@endsection
