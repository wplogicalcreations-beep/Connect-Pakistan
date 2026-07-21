<div class="page-title">
    <h2>Welcome <Span class="spec-color">{{auth()->user()->name}}</Span></h2>
</div>
<div class="home-main section">
    <div class="row g-4">

        <!-- Profile Completion Box -->
        <div class="col-lg-6 col-md-12">
            <div class="profile-box d-flex">
                <div class="me-3 perc-valu">
                    <span class="calculate-percent">92%</span>
                    <p>of Your Profile is Completed.</p>
                </div>
                <div>
                    <div class="d-flex flex-grow-1">
                        <!-- 4 steps representing 25% each -->
                        <div class="step-main active calculate-bar"></div>
                        <div class="step-main active  calculate-bar"></div>
                        <div class="step-main active  calculate-bar"></div>
                        <div class="step-main  calculate-bar"></div>
                    </div>

                    <h5 class="my-3">Complete Your Profile</h5>
                    <p class="pb-3">Click "Complete Profile" and follow the simple steps to build your
                        profile. Your resume will be automatically generated based on the information you
                        provide. Be sure to include all required details for a strong and complete profile.
                    </p>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <a href="{{ route('user.profile') }}" class="btn btn-complete">Complete Profile →</a>
                        <a href="#" class="text-decoration-none text-muted small tooltip-container">
                            Why this important? 
                            <span class="info-icon">
                                <img src="{{ asset('user-dash-img/iota.svg')}}" alt="Iota Icon">
                            </span>
                            <span class="tooltip-text">
                                Your profile is your online resume. Complete it to reflect your expertise, achievements, and career goals, so you attract the right connections and opportunities.                            </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Invites Box -->
        <div class="col-lg-6 col-md-12">
            <div class="event-box">
                <h5 class="mb-2">Personal Event Invites <span class="ms-1"><img src="{{ asset('user-dash-img/bill.svg')}}"
                            alt="Bill Icon"></span></h5>

                <!-- Event 1 -->
                <div class="event-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="event-title">PAK-KSA Tech Event 2025!</div>
                            <p class="text-muted">Pak-KSA Tech Event 2025 brings together innovators, tech
                                leaders, and startups from Pakistan and Saudi Arabia to explore
                                collaboration..</p>
                        </div>
                        <small class="text-muted text-nowrap ms-2"><img src="{{ asset('user-dash-img/uil_calender.svg')}}"
                                alt="Calendar Icon"> May 20th, 2025</small>
                    </div>
                </div>

                <!-- Event 2 -->
                <div class="event-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="event-title">Global Business Event 2025!</div>
                            <p class="text-muted">Global Business Event 2025 is a premier platform uniting
                                industry leaders, entrepreneurs, and innovators from around the world to
                                connect, collaborate...</p>
                        </div>
                        <small class="text-muted text-nowrap ms-2"><img src="{{ asset('user-dash-img/uil_calender.svg')}}"
                                alt="Calendar Icon"> June 18th, 2025</small>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

</div>
