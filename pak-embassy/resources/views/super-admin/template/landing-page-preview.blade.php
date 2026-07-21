@extends("layouts.master")
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<main class="embassy-main-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light nav_desktop">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/images/templates/embassy-of-PK 1.svg" alt="logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse side-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Portal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Knowledge Base</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Job Notice Board</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact US</a>
                    </li>


                </ul>
                <button class="btn btn-right-arrow">Sign In <img src="assets/images/templates/right-arrow.svg"
                        alt="right-arrow" class="img-fluid "></button>
            </div>
        </div>
    </nav>


    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light offcanvas_nav">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/images/templates/embassy-of-PK 1.svg" alt="logo" class="img-fluid">
            </a>

            <!-- Offcanvas toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas menu -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Portal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Knowledge Base</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Job Notice Board</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                    </ul>
                    <button class="btn btn-right-arrow mt-3">
                        Sign In <img src="assets/images/templates/right-arrow.svg" alt="right-arrow"
                            class="img-fluid">
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <section>
    <div id="strenghTiesCarousel" class="carousel slide strengh-ties" data-bs-ride="carousel">
        <!-- Indicators (dots) -->
        <div class="carousel-indicators d-flex">
            <button type="button" data-bs-target="#strenghTiesCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#strenghTiesCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#strenghTiesCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">

            <!-- Carousel Item 1 -->
            <div class="carousel-item active">
                <div class="strengh-ties-box">
                    <div class="container">
                        <div class="row g-5">
                            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                                <div class="frame-left-content">
                                    <h2>Strengthening Ties, Enabling Success</h2>
                                    <p>Strengthen bilateral trade and economic cooperation through strategic networking,
                                        business meetups, and embassy-supported collaborations</p>
                                    <div>
                                        <button class="btn register-btn">Register Now</button>
                                        <button class="btn learn-more">Learn More 
                                            <img src="assets/images/templates/right-arrow.svg" alt="right-arrow" class="img-fluid">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                                <div class="right-frame-main">
                                    <img src="assets/images/templates/banner-frame-right.png" alt="right-frame" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Item 2 -->
            <div class="carousel-item">
                <div class="strengh-ties-box">
                    <div class="container">
                        <div class="row g-5">
                            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                                <div class="frame-left-content">
                                    <h2>Strengthening Ties, Enabling Success</h2>
                                    <p>Strengthen bilateral trade and economic cooperation through strategic networking,
                                        business meetups, and embassy-supported collaborations</p>
                                    <div>
                                        <button class="btn register-btn">Register Now</button>
                                        <button class="btn learn-more">Learn More 
                                            <img src="assets/images/templates/right-arrow.svg" alt="right-arrow" class="img-fluid">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                                <div class="right-frame-main">
                                    <img src="assets/images/templates/banner-frame-right.png" alt="right-frame" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Item 3 -->
            <div class="carousel-item">
                <div class="strengh-ties-box">
                    <div class="container">
                        <div class="row g-5">
                            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                                <div class="frame-left-content">
                                    <h2>Strengthening Ties, Enabling Success</h2>
                                    <p>Strengthen bilateral trade and economic cooperation through strategic networking,
                                        business meetups, and embassy-supported collaborations</p>
                                    <div>
                                        <button class="btn register-btn">Register Now</button>
                                        <button class="btn learn-more">Learn More 
                                            <img src="assets/images/templates/right-arrow.svg" alt="right-arrow" class="img-fluid">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                                <div class="right-frame-main">
                                    <img src="assets/images/templates/banner-frame-right.png" alt="right-frame" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


    <section class="ambassador-vision">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-right" data-aos-duration="1000">
                    <div class="ambassador-img">
                        <img src="assets/images/templates/ambasodor.png" alt="ambasodor" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left" data-aos-duration="1000">
                    <div class="ambasodor-vision-right-content">
                        <div>
                            <img src="assets/images/templates/ambsdr-icons-Group.svg" alt="">
                            <span class="ms-2">Ambassador Vision</span>
                        </div>
                        <h3><span>H.E. Ahmad Farooq</span> Ambassador of Pakistan to Kingdom of Saudi Arabia</h3>
                        <div class="ambasodor-text">
                            <img src="assets/images/templates/carbon_quotes.svg" alt=""
                                class="img-fluid">
                            <p>
                                To enhance the integration and success of Pakistani talent and businesses in the
                                Kingdom of Saudi Arabia by fostering strategic partnerships, facilitating knowledge
                                exchange, encouraging entrepreneurship, enabling workforce development, supporting
                                innovation, strengthening trade relations, promoting cultural synergy, and advancing
                                bilateral economic collaboration that drives sustainable growth, mutual prosperity,
                                and long-term regional impact.
                                <img src="assets/images/templates/carbon_quotes.svg" alt=""
                                    class="img-fluid">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="pak-ksa-main">
        <div class="container">
            <div class="row g-5">

                <div class="col-lg-8" data-aos="fade-right" data-aos-duration="1000">
                    <div class="pak-ksa-content">
                        <div>
                            <img src="assets/images/templates/ambsdr-icons-Group.svg" alt=""
                                class="img-fluid">
                            <span class="ms-2">Why NEED Us</span>
                        </div>
                        <h3>Empowering Pakistanis in KSA through <span>Trusted Embassy Connections.</span></h3>
                        <p class="pak-ksa-text">An official platform by the Embassy of Pakistan to connect, verify,
                            and support Pakistani professionals and businesses in Saudi Arabia.</p>
                        <div class="card-main">
                            <div class="card-single">
                                <div class="icon-area">
                                    <img src="assets/images/templates/business-growth.svg" alt="">
                                    <p class="mb-0">Business Growth</p>
                                </div>
                                <div class="card-text">
                                    <img src="assets/images/templates/small-tick.svg" alt=""
                                        class="img-fluid">
                                    <span>Expand market reach</span>
                                </div>
                                <div class="card-text">
                                    <img src="assets/images/templates/small-tick.svg" alt=""
                                        class="img-fluid">
                                    <span>Innovate through feedback</span>
                                </div>
                            </div>
                            <div class="card-single">
                                <div>
                                    <img src="assets/images/templates/talent-discovery.svg" alt=""
                                        class="icon-area-2">
                                    <p class="mb-0">Talent Discovery</p>
                                </div>
                                <div class="card-text">
                                    <img src="assets/images/templates/small-tick.svg" alt=""
                                        class="img-fluid">
                                    <span>Identify skilled individuals</span>
                                </div>
                                <div class="card-text">
                                    <img src="assets/images/templates/small-tick.svg" alt=""
                                        class="img-fluid">
                                    <span>Nurture emerging talent</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-rgstr">Register Now <img
                                src="assets/images/templates/right-arrow.svg" alt=""
                                class="img-fluid"></button>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-left" data-aos-duration="1000">
                    <div class="pak-ksa-img">
                        <img src="assets/images/templates/pak-ksa.png" alt="ambasodor" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="benefits">
        <div class="container">


            <div class="benefit-top" data-aos="fade-down" data-aos-duration="1000">
                <img src="assets/images/templates/ambsdr-icons-Group.svg" alt="" class="img-fluid">
                <span class="ms-2">Benefits</span>
                <h3>Benefits for <span>Professionals, Businesses, & the Nation.</span></h3>
            </div>
            <div class="card-main-benefits">
                <div class="row g-4">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                        <div class="card-single">
                            <img src="assets/images/templates/card-img-1.png" alt="">
                            <div>
                                <div>
                                    <h5>For All User</h5>
                                    <ul>
                                        <li>Easy access anytime</li>
                                        <li>Improved overall user experience</li>
                                        <li>Equal value for everyone</li>
                                    </ul>
                                </div>
                                <img src="assets/images/templates/card-inactive.svg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                        <div class="card-single">
                            <img src="assets/images/templates/card-img-2.png" alt="">
                            <div>
                                <div>
                                    <h5>For Diaspora </h5>
                                    <ul>
                                        <li>Connect globally with diaspora</li>
                                        <li>Share culture and experiences</li>
                                        <li>Empower communities through unity</li>
                                    </ul>
                                </div>
                                <img src="assets/images/templates/card-active.svg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-single">
                            <img src="assets/images/templates/card-img-3.png" alt="">
                            <div>
                                <div>
                                    <h5>For Non-Diaspora</h5>
                                    <ul>
                                        <li>Learn about diverse cultures</li>
                                        <li>Connect with global communities</li>
                                        <li>Support inclusion and unity</li>
                                    </ul>
                                </div>
                                <img src="assets/images/templates/card-inactive.svg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-single">
                            <img src="assets/images/templates/card-img-4.png" alt="">
                            <div>
                                <div>
                                    <h5>For Embassy </h5>
                                    <ul>
                                        <li>Explore global cultures</li>
                                        <li>Build strong connections</li>
                                        <li>Foster lasting unity</li>
                                    </ul>
                                </div>
                                <img src="assets/images/templates/card-inactive.svg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="journey-begins">
                <div data-aos="fade-down" data-aos-duration="1000">
                    <img src="assets/images/templates/ambsdr-icons-Group.svg" alt=""
                        class="img-fluid invert-img">
                    <span class="ms-2">How it works</span>
                </div>
                <h4 data-aos="fade-down" data-aos-duration="1000">Your Journey Begins in Just a Few Steps.</h4>
                <div class="row g-5">
                    <div class="col-lg-8" data-aos="fade-right" data-aos-duration="1000">
                        <div class="points-main">
                            <div class="single-point">
                                <div>
                                    <span>01</span>
                                </div>
                                <div class="single-point-text">
                                    <h5>Create your account with us.</h5>
                                    <p>Sign up using your email and basic information to get started.</p>
                                </div>
                            </div>
                            <div class="single-point">
                                <div>
                                    <span>02</span>
                                </div>
                                <div class="single-point-text">
                                    <h5>Submit you documents & get verified by embassy.</h5>
                                    <p>Upload required documents securely and wait for quick embassy verification.
                                    </p>
                                </div>
                            </div>
                            <div class="single-point">
                                <div>
                                    <span>03</span>
                                </div>
                                <div class="single-point-text">
                                    <h5>Explore different benefit with us.</h5>
                                    <p>Access exclusive services, community support, and cultural programs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-lg-block d-none" data-aos="fade-left" data-aos-duration="1000">
                        <div class="journey-right-area">
                            <div class="social-items">
                                <a href=""> <img src="assets/images/templates/x-icon.svg"
                                        alt=""></a>
                                <a href=""> <img src="assets/images/templates/facebook-f.svg"
                                        alt=""></a>
                                <a href=""> <img src="assets/images/templates/instagram.svg"
                                        alt=""></a>
                                <a href=""><img src="assets/images/templates/linkedin-in.svg"
                                        alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn journey-begins-btn" data-aos="fade-up" data-aos-duration="1000">Register Now
                    <img src="assets/images/templates/right-arrow.svg" alt="right-arrow"
                        class="img-fluid invert-img"></button>
            </div>
        </div>
    </section>
    <section class="event-sec">
        <div class="container">
            <div class="event-top mb-4" data-aos="fade-down" data-aos-duration="1000">
                <img src="assets/images/templates/ambsdr-icons-Group.svg" alt="" class="img-fluid">
                <span class="ms-2">Upcoming events</span>
                <h3 data-aos="fade-down" data-aos-duration="1000"> Events That Connect.<span>Inspire.
                        Elevate.</span></h3>
            </div>
            <div class="row g-3">
                @foreach($events as $event)
                    <div class="col-lg-4" data-aos="fade-right" data-aos-duration="1000">
                        <div class="single-card">
                            <img src="{{ asset('storage/' . $event->images->first()?->path) }}" alt="" class="img-fluid w-100">
                            <div class="card-txt">
                                <div>
                                    <h4>{{ $event->name }}</h4>
                                    <p>{!! $event->event_overview !!}</p>
                                </div>
                                <img src="assets/images/templates/card-inactive.svg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-center " data-aos="fade-up" data-aos-duration="1000">
                    <button class="btn btn-view-more">View More <img src="assets/images/templates/right-arrow.svg"
                            alt="right-arrow" class="img-fluid "></button>
                </div>
            </div>
        </div>
    </section>
    <section class="empowering-sec">
        <div class="container">
            <div class="empowering-wrapper">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <h2>Empowering You to Grow in KSA — One Click Away.</h2>
                    <p>Create your account today and become part of a trusted, embassy-backed platform connecting
                        Pakistani talent and businesses across KSA.</p>
                </div>
                <button class="btn journey-begins-btn" data-aos="fade-right" data-aos-duration="1000">Get Started
                    Now</button>

            </div>
        </div>
    </section>
    <footer>
        <div class="container top-contianer">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-logo-area">
                        <img src="assets/images/templates/footer-logo.png" alt="" class="img-fluid">
                        {{-- <img src="assets/images/templates/footer-map.png" alt=""
                            class="img-fluid map-icon"> --}}
                    </div>
                    <p class="footer-text">Empowering the Pakistani Diaspora, Enabling Progress Through Innovation,
                        Partnership, and Opportunity.</p>

                    <div class="footer-social-items">
                        <a href=""> <img src="assets/images/templates/facebook-f.svg" alt=""></a>
                        <a href=""> <img src="assets/images/templates/instagram.svg" alt=""></a>
                        <a href=""> <img src="assets/images/templates/x-icon.svg" alt=""></a>
                        <a href=""><img src="assets/images/templates/linkedin-in.svg" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="useful-links">
                        <h6>Useful Link</h6>
                        <ul>
                            <li><a href=""><img src="assets/images/templates/footer-arrow.png"
                                        alt=""> Portal</a></li>
                            <li><a href=""><img src="assets/images/templates/footer-arrow.png"
                                        alt=""> Knowledge Base</a></li>
                            <li><a href=""><img src="assets/images/templates/footer-arrow.png"
                                        alt=""> Job Notice Board</a>
                            </li>
                            <li><a href=""><img src="assets/images/templates/footer-arrow.png"
                                        alt=""> Events</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="news-letter">
                        <h6>Subscribe Our Newsletter</h6>
                        <p>Find Your News, Settle Your Mind — Every Story Curated for Your Peace of Mind.</p>
                        <div class="news-email">
                            <input type="email" placeholder="Enter Email" class="form-control">
                            <button class="btn email-send-btn "><img src="assets/images/templates/email-icon.svg"
                                    alt=""></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="copy-rights">

                <p>© Pakistan-Saudi Arabia Embassy 2025 | All Rights Reserved</p>
                <ul>
                    <li> <a href="">Terms & Conditions</a></li>
                    <li><a href="">Privacy Policy</a></li>
                    <li><a href="">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </footer>
</main>
@endsection