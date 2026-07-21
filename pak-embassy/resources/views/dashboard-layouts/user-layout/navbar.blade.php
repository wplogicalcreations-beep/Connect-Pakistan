<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
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

                    <span>
                        <div class="red-notify-dot"></div>
                        <i class="fa-regular fa-bell" style="color: #fff;"></i>
                    </span>
                    <div class="dropdown d-flex align-items-center">
                        @if(auth()->user()->images && auth()->user()->images->first())
                        <img src="{{ asset('storage/' . auth()->user()->images->first()->path) }}"
                            alt="profile-photo"
                            class="rounded-circle me-2"
                            width="40"
                            height="40">
                        @else
                        <img src="{{ asset('images/Users.svg') }}"
                            alt="default-photo"
                            class="rounded-circle me-2"
                            width="40"
                            height="40">
                        @endif
                        <button class="btn btn-white dropdown-toggle p-0" type="button" id="dropdownUser"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 p-0 text-light">{{auth()->user()->name}}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item" href="{{ url('/user/profile')}}"><i
                                        class="fa-solid fa-user me-2"></i>Manage Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasscodeModal"><i
                                        class="fa-solid fa-key me-2"></i>Change Passcode</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
                                    </li>
                        </ul>
                    </div>
                    <form id="logout-form" action="/user/logout" method="POST" style="display: none;">
                                @csrf
                            </form>
                </div>
            </div>
        </nav>
    </div>
</div>