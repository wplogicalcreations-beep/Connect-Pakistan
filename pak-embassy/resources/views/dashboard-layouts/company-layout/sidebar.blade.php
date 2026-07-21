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
                    {{-- Dashboard --}}
                    <li class="{{ request()->is('company/dashboard') ? 'active mainDash show' : 'mainDash show' }}">
                        <a href="{{ url('company/dashboard') }}">
                            <img class="mr-2 radius-image" src="{{ asset('user-dash-img/dash-logo.svg') }}"
                                alt="Dashboard logo">
                            Dashboard
                        </a>
                    </li>

                    {{-- Job Board (Company) --}}
                    @php
                        $jobRoutes = ['company/discover-job', 'company/applied-job', 'company/detail-job*', 'company/job-apply*'];
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
                                <a href="{{ url('/company/discover-job') }}"
                                    class="childActive {{ request()->is('company/discover-job') || request()->is('company/detail-job*') || request()->is('company/job-apply*') ? 'active' : '' }}">
                                    <span>Your Jobs</span>
                                </a>
                            </li>
                            <li id="child">
                                <a href="{{ url('/company/applied-job') }}"
                                    class="childActive {{ request()->is('company/applied-job') ? 'active' : '' }}">
                                    <span>Jobs Application</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Events (Company) --}}
                    @php
                        $eventRoutes = ['company/public-event', 'company/your-event', 'company/event-detail*'];
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
                                <a href="{{ url('/company/public-event') }}"
                                    class="childActive {{ request()->is('company/public-event') || request()->is('company/event-detail*') ? 'active' : '' }}">
                                    <span>Public Events</span>
                                </a>
                            </li>
                            <li id="child">
                                <a href="{{ url('/company/your-event') }}"
                                    class="childActive {{ request()->is('company/your-event') ? 'active' : '' }}">
                                    <span>Your Events</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Co-WorkSpace --}}
                    <li class="single {{ request()->is('company/co-work-space*') ? 'active' : '' }}">
                        <a href="{{ url('/company/co-work-space') }}"
                            class="text-decoration-none {{ request()->is('company/co-work-space*') ? 'active' : '' }}">
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
