<div class="iq-sidebar">
    <div id="sidebar-scrollbar" class="overflow-auto" tabindex="-1">
        <div class="scroll-content">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu list-unstyled">
                    <div class="main-logo">
                        <img src="{{ asset('user-dash-img/logo.png') }}" alt="Project Logo">
                        <div class="close-sidebar">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                    <li class="{{ request()->is('user/dashboard') ? 'active mainDash show' : 'mainDash show' }}">
                        <a href="{{ url('user/dashboard') }}">
                            <img class="mr-2 radius-image" src="{{ asset('user-dash-img/dash-logo.svg') }}"
                                alt="Dashboard logo">Dashboard
                        </a>
                    </li>
                    @php
                        $jobRoutes = ['user/discover-job', 'user/applied-job', 'user/detail-job*', 'user/job-apply*'];
                    @endphp
                    <li class="liMain">
                        <a href="#Complaints" class="activeParent {{ request()->is($jobRoutes) ? 'active' : '' }}"
                            data-bs-toggle="collapse"
                            aria-expanded="{{ request()->is($jobRoutes) ? 'true' : 'false' }}">
                            <img class="mr-2 radius-image sub-side" src="{{ asset('user-dash-img/board-icon.svg') }}"
                                alt="Complaints logo">
                            <span class="parent">Job Board</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </a>

                        <ul id="Complaints"
                            class="iq-submenu collapse child {{ request()->is($jobRoutes) ? 'show' : '' }}">
                            <li id="child">
                                <a href="{{ url('/user/discover-job') }}"
                                    class="childActive {{ request()->is('user/discover-job') || request()->is('user/detail-job*') || request()->is('user/job-apply*') ? 'active' : '' }}">
                                    <span>Discover Jobs</span>
                                </a>
                            </li>
                            <li id="child">
                                <a href="{{ url('/user/applied-job') }}"
                                    class="childActive {{ request()->is('user/applied-job') ? 'active' : '' }}">
                                    <span>Applied Jobs</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @php
                        $eventRoutes = ['user/public-event', 'user/your-event', 'user/event-detail*'];
                    @endphp

                    <li class="liMain">
                        <a href="#Logs" class="activeParent {{ request()->is($eventRoutes) ? 'active' : '' }}"
                            data-bs-toggle="collapse"
                            aria-expanded="{{ request()->is($eventRoutes) ? 'true' : 'false' }}">
                            <img class="mr-2 radius-image sub-side" src="{{ asset('user-dash-img/event-icon.svg') }}"
                                alt="Logs logo">
                            <span class="parent">Events</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </a>

                        <ul id="Logs"
                            class="iq-submenu collapse child {{ request()->is($eventRoutes) ? 'show' : '' }}">
                            <li id="child">
                                <a href="{{ url('/user/public-event') }}"
                                    class="childActive {{ request()->is('user/public-event') || request()->is('user/event-detail*') ? 'active' : '' }}">
                                    <span>Public Events</span>
                                </a>
                            </li>
                            <li id="child">
                                <a href="{{ url('/user/your-event') }}"
                                    class="childActive {{ request()->is('user/your-event') ? 'active' : '' }}">
                                    <span>Your Events</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="single {{ request()->is('user/co-work-space*') ? 'active' : '' }}">
                        <a href="{{ url('/user/co-work-space') }}"
                            class="text-decoration-none {{ request()->is('user/co-work-space*') ? 'active' : '' }}">
                            <img class="mr-2 radius-image sub-side" src="{{ asset('user-dash-img/co-work-icon.svg') }}"
                                alt="Users logo">
                                Co-working Space
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>
