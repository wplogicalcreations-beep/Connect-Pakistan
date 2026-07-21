<div class="iq-top-navbar">
    <div class="iq-navbar-custom py-0">
        <div class="navbar-breadcrumb d-flex align-items-center">
            <div class="open-sidebar">
                <i class="fa-solid fa-bars-staggered ps-0 pe-2"></i>
            </div>
            <h5 class="mb-0">
                <i class="fa-solid fa-bars me-2 collapse-sidebar"></i>
                Welcome!
            </h5>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid justify-content-end">
                <div class="topBar-right ">

                    <div class="dropdown">
                        <span class="notification-bell" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer; position: relative;">
                            <div class="red-notify-dot" id="logDot" style="display: none;"></div>
                            <i class="fa-regular fa-bell" style="color: #fff;"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-end log-dropdown" style="min-width: 320px; max-width: 350px; max-height: 500px; overflow-y: auto; padding: 0;" id="logDropdown">
                            <div class="dropdown-header" style="padding: 10px 15px;">
                                <strong>Activity Logs (Today)</strong>
                            </div>
                            <hr class="dropdown-divider m-0">
                            <div id="logList" style="padding: 0;">
                                <div class="text-center p-3 text-muted">
                                    <small>Loading logs...</small>
                                </div>
                            </div>
                            <div id="noLogs" style="display: none; padding: 0;">
                                <div class="text-center p-3 text-muted">
                                    <small>No logs for today</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown d-flex align-items-center">
                        <img src="{{ asset('images/Users.svg') }}" alt="profile-photo"
                            class="rounded-circle me-2" width="40" height="40">

                        <button class="btn btn-white dropdown-toggle p-0" type="button" id="dropdownUser"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 p-0 text-light">{{ Auth::user()->email }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                            {{-- <li><a class="dropdown-item" href="#"><i
                                        class="bi bi-person me-2"></i>Profile</a></li>
                            <li>
                                <hr class="dropdown-divider"> --}}
                            </li>
                            <li><a class="dropdown-item text-danger" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="bi bi-box-arrow-right me-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                    <form id="logout-form" action="embassy/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div>
