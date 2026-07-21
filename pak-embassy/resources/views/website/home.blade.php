@extends('layouts.landing-page')

@section('title', 'Home Page')

@section('content')
    <section>
        <div class="strengh-ties">
            <div class="strengh-ties-box" style="background-image: url('{{ isset($data) ? $data['HeroSection1']['Background Image'] : 'assets/images/templates/banner-bg.png' }}');
                background-size: cover;
                background-repeat: no-repeat;
                height: 618px;
                color: #fff;
                padding: 46px 0;">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                            <div class="frame-left-content">
                                <h2>{{ isset($data) ? $data['HeroSection1']['Title'] : 'Strengthening Ties, Enabling Success' }}</h2>
                                <p>{!! isset($data) ? $data['HeroSection1']['Description'] : 'Strengthen bilateral trade and economic cooperation through strategic networking,
                                    business
                                    meetups, and embassy-supported collaborations' !!}</p>
                                <div>
                                    <a href="#" class="btn register-btn" data-bs-toggle="modal"
                                        data-bs-target="#joinAs">{{ isset($data) ? $data['HeroSection1']['Register Now Button']['Text'] : 'Register Now' }}</span></a>
                                    <!-- <a data-bs-toggle="modal"
                                        data-bs-target="#joinAs"
                                        class="btn register-btn">
                                        {{ isset($data) ? $data['HeroSection1']['Register Now Button']['Text'] : 'Register Now' }}
                                    </a> -->

                                    <a href="{{ isset($data) ? $data['HeroSection1']['Learn More Button']['Url'] : '#' }}"
                                        class="btn learn-more">
                                        {{ isset($data) ? $data['HeroSection1']['Learn More Button']['Text'] : 'Learn More' }}
                                        <img src="assets/images/templates/right-arrow.svg" alt="right-arrow" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                            <div class="right-frame-main">
                                <img src="{{ isset($data) ? $data['HeroSection1']['Image'] : 'assets/images/templates/banner-frame-right.png' }}" alt="right-frame"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="strengh-ties-box" style="background-image: url('{{ isset($data) ? $data['HeroSection2']['Background Image'] : 'assets/images/templates/banner-bg.png' }}');
                background-size: cover;
                background-repeat: no-repeat;
                height: 618px;
                color: #fff;
                padding: 46px 0;">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                            <div class="frame-left-content">
                                <h2>{{ isset($data) ? $data['HeroSection2']['Title'] : 'Strengthening Ties, Enabling Success' }}</h2>
                                <p>{!! isset($data) ? $data['HeroSection2']['Description'] : 'Strengthen bilateral trade and economic cooperation through strategic networking,
                                    business
                                    meetups, and embassy-supported collaborations' !!}</p>
                                <div>
                                    <a href="#" class="btn register-btn" data-bs-toggle="modal"
                                        data-bs-target="#joinAs">{{ isset($data) ? $data['HeroSection2']['Register Now Button']['Text'] : 'Register Now' }}</span></a>

                                    <a href="{{ isset($data) ? $data['HeroSection2']['Learn More Button']['Url'] : '#' }}"
                                        class="btn learn-more">
                                        {{ isset($data) ? $data['HeroSection2']['Learn More Button']['Text'] : 'Learn More' }}
                                        <img src="assets/images/templates/right-arrow.svg" alt="right-arrow" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                            <div class="right-frame-main">
                                <img src="{{ isset($data) ? $data['HeroSection2']['Image'] : 'assets/images/templates/banner-frame-right.png' }}" alt="right-frame"
                                    class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="strengh-ties-box">
                <div class="container">
                    <div class="row g-5" style="background-image: url('{{ isset($data) ? $data['HeroSection3']['Background Image'] : 'assets/images/templates/banner-bg.png' }}');
                    background-size: cover;
                    background-repeat: no-repeat;
                    height: 618px;
                    color: #fff;
                    padding: 46px 0;">
                        <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                            <div class="frame-left-content">
                                <h2>{{ isset($data) ? $data['HeroSection3']['Title'] : 'Strengthening Ties, Enabling Success' }}</h2>
                                <p>{!! isset($data) ? $data['HeroSection3']['Description'] : 'Strengthen bilateral trade and economic cooperation through strategic networking,
                                    business
                                    meetups, and embassy-supported collaborations' !!}</p>
                                <div>
                                    <a href="#" class="btn register-btn" data-bs-toggle="modal"
                                        data-bs-target="#joinAs">{{ isset($data) ? $data['HeroSection3']['Register Now Button']['Text'] : 'Register Now' }}</span></a>

                                    <a href="{{ isset($data) ? $data['HeroSection3']['Learn More Button']['Url'] : '#' }}"
                                        class="btn learn-more">
                                        {{ isset($data) ? $data['HeroSection3']['Learn More Button']['Text'] : 'Learn More' }}
                                        <img src="assets/images/templates/right-arrow.svg" alt="right-arrow" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                            <div class="right-frame-main">
                                <img src="{{ isset($data) ? $data['HeroSection3']['Image'] : 'assets/images/templates/banner-frame-right.png' }}" alt="right-frame"
                                    class="img-fluid">
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
                        <img src="{{ isset($data) ? $data['AmbassadorMessageSection']['Image'] : 'assets/images/templates/ambasodor.png' }}" alt="ambasodor" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left" data-aos-duration="1000">
                    <div class="ambasodor-vision-right-content">
                        <div>
                            <img src="{{ isset($data) ? $data['AmbassadorMessageSection']['Title Icon'] : 'assets/images/templates/ambsdr-icons-Group.svg' }}" alt="">
                            <span class="ms-2">{{ isset($data) ? $data['AmbassadorMessageSection']['Title'] : 'Ambassador Vision' }}</span>
                        </div>
                        <h3>
                            {!! isset($data)
                            ? $data['AmbassadorMessageSection']['Subtitle']
                            : '<span>H.E. Ahmad Farooq</span> Ambassador of Pakistan to Kingdom of Saudi Arabia' !!}
                        </h3>
                        <div class="ambasodor-text">
                            <img src="assets/images/templates/carbon_quotes.svg" alt=""
                                class="img-fluid">
                            <p>
                                {!! isset($data)
                                ? $data['AmbassadorMessageSection']['Description']
                                : 'To enhance the integration and success of Pakistani talent and businesses in the
                                Kingdom of Saudi Arabia by fostering strategic partnerships, facilitating knowledge
                                exchange, encouraging entrepreneurship, enabling workforce development, supporting
                                innovation, strengthening trade relations, promoting cultural synergy, and advancing
                                bilateral economic collaboration that drives sustainable growth, mutual prosperity,
                                and long-term regional impact.' !!}
                                <img src="assets/images/templates/carbon_quotes.svg" alt="" class="img-fluid">
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
                            <img src="{{ isset($data) ? $data['WhyNeedUsSection']['Title Icon'] : 'assets/images/templates/ambsdr-icons-Group.svg' }}" alt=""
                                class="img-fluid">
                            <span class="ms-2">{{ isset($data) ? $data['WhyNeedUsSection']['Title'] : 'Why NEED Us' }}</span>
                        </div>
                        <h3>
                            {!! isset($data)
                            ? $data['AmbassadorMessageSection']['Subtitle']
                            : 'Empowering Pakistanis in KSA through <span>Trusted Embassy Connections.</span>' !!}
                        </h3>
                        <p class="pak-ksa-text">{!! isset($data) ? $data['WhyNeedUsSection']['Description'] : 'An official platform by the Embassy of Pakistan to connect, verify,
                            and support Pakistani professionals and businesses in Saudi Arabia.' !!}</p>
                        <div class="card-main">
                            <div class="card-single">
                                <div class="icon-area">
                                    <img src="{{ isset($data) ? $data['WhyNeedUsSection']['Business Growth']['Icon'] : 'assets/images/templates/business-growth.svg' }}" alt="">
                                    <p class="mb-0">{{ isset($data) ? $data['WhyNeedUsSection']['Business Growth']['Title'] : 'Business Growth' }}</p>
                                </div>
                                <div class="card-text">
                                    <img src="assets/images/templates/small-tick.svg" alt=""
                                        class="img-fluid">
                                    <span>{{ isset($data) ? $data['WhyNeedUsSection']['Business Growth']['Description']['One'] : 'Expand market reach' }}</span>
                                </div>
                                <div class="card-text">
                                    <img src="assets/images/templates/small-tick.svg" alt=""
                                        class="img-fluid">
                                    <span>{{ isset($data) ? $data['WhyNeedUsSection']['Business Growth']['Description']['Two'] : 'Innovate through feedback' }}</span>
                                </div>
                            </div>
                            <div class="card-single">
                                <div>
                                    <img src="{{ isset($data) ? $data['WhyNeedUsSection']['Talent Discovery']['Icon'] : 'assets/images/templates/talent-discovery.svg' }}" alt=""
                                        class="icon-area-2">
                                    <p class="mb-0">{{ isset($data) ? $data['WhyNeedUsSection']['Talent Discovery']['Title'] : 'Talent Discovery' }}</p>
                                </div>
                                <div class="card-text">
                                    <img src="assets/images/templates/small-tick.svg" alt=""
                                        class="img-fluid">
                                    <span>{{ isset($data) ? $data['WhyNeedUsSection']['Talent Discovery']['Description']['One'] : 'Identify skilled individuals' }}</span>
                                </div>
                                <div class="card-text">
                                    <img src="assets/images/templates/small-tick.svg" alt=""
                                        class="img-fluid">
                                    <span>{{ isset($data) ? $data['WhyNeedUsSection']['Talent Discovery']['Description']['Two'] : 'Nurture emerging talent' }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="#"  class="btn btn-rgstr" data-bs-toggle="modal"
                            data-bs-target="#joinAs">{{ isset($data) ? $data['HeroSection1']['Register Now Button']['Text'] : 'Register Now' }}
                            <img src="assets/images/templates/right-arrow.svg" alt="" class="img-fluid"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-left" data-aos-duration="1000">
                    <div class="pak-ksa-img">
                        <img src="{{ isset($data) ? $data['WhyNeedUsSection']['Image'] : 'assets/images/templates/pak-ksa.png' }}" alt="ambasodor" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="benefits">
        <div class="container">
            <div class="benefit-top" data-aos="fade-down" data-aos-duration="1000">
                <img src="{{ isset($data) ? $data['BenefitsSection']['Title Icon'] : 'assets/images/templates/ambsdr-icons-Group.svg' }}" alt="" class="img-fluid">
                <span class="ms-2">{{ isset($data) ? $data['BenefitsSection']['Title'] : 'Benefits' }}</span>
                <h3>
                    {!! isset($data)
                    ? $data['BenefitsSection']['Subtitle']
                    : 'Benefits for <span>Professionals, Businesses, & the Nation.</span>' !!}
                </h3>
            </div>
            <div class="card-main-benefits">
                <div class="row g-4">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                        <div class="card-single">
                            <img src="{{ isset($data) ? $data['BenefitsSection']['Cards']['For All User']['Image'] : 'assets/images/templates/card-img-1.png' }}" alt="">
                            <div>
                                <div>
                                    <h5>{{ isset($data) ? $data['BenefitsSection']['Cards']['For All User']['Title'] : 'For All User' }}</h5>
                                    {!! isset($data)
                                    ? $data['BenefitsSection']['Cards']['For All User']['description']
                                    : '<ul>
                                        <li>Easy access anytime</li>
                                        <li>Improved overall user experience</li>
                                        <li>Equal value for everyone</li>
                                    </ul>' !!}
                                </div>
                                <img src="assets/images/templates/card-inactive.svg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                        <div class="card-single">
                            <img src="{{ isset($data) ? $data['BenefitsSection']['Cards']['For Diaspora']['Image'] : 'assets/images/templates/card-img-2.png' }}" alt="">
                            <div>
                                <div>
                                    <h5>{{ isset($data) ? $data['BenefitsSection']['Cards']['For Diaspora']['Title'] : 'For Diaspora' }} </h5>
                                    {!! isset($data)
                                    ? $data['BenefitsSection']['Cards']['For Diaspora']['description']
                                    : '<ul>
                                        <li>Connect globally with diaspora</li>
                                        <li>Share culture and experiences</li>
                                        <li>Empower communities through unity</li>
                                    </ul>' !!}
                                </div>
                                <img src="assets/images/templates/card-active.svg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-single">
                            <img src="{{ isset($data) ? $data['BenefitsSection']['Cards']['For Non-Diaspora']['Image'] : 'assets/images/templates/card-img-3.png' }}" alt="">
                            <div>
                                <div>
                                    <h5>{{ isset($data) ? $data['BenefitsSection']['Cards']['For Non-Diaspora']['Title'] : 'For Non-Diaspora' }}</h5>
                                    {!! isset($data)
                                    ? $data['BenefitsSection']['Cards']['For Non-Diaspora']['description']
                                    : '<ul>
                                        <li>Learn about diverse cultures</li>
                                        <li>Connect with global communities</li>
                                        <li>Support inclusion and unity</li>
                                    </ul>' !!}
                                </div>
                                <img src="assets/images/templates/card-inactive.svg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card-single">
                            <img src="{{ isset($data) ? $data['BenefitsSection']['Cards']['For Embassy']['Image'] : 'assets/images/templates/card-img-4.png' }}" alt="">
                            <div>
                                <div>
                                    <h5>{{ isset($data) ? $data['BenefitsSection']['Cards']['For Embassy']['Title'] : 'For Embassy' }} </h5>
                                    {!! isset($data)
                                    ? $data['BenefitsSection']['Cards']['For Embassy']['description']
                                    : '<ul>
                                        <li>Explore global cultures</li>
                                        <li>Build strong connections</li>
                                        <li>Foster lasting unity</li>
                                    </ul>' !!}
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
                    <img src="{{ isset($data) ? $data['HowItWorksSection']['Title Icon'] : 'assets/images/templates/ambsdr-icons-Group.svg' }}" alt=""
                        class="img-fluid invert-img">
                    <span class="ms-2">{{ isset($data) ? $data['HowItWorksSection']['Title'] : 'How it works' }}</span>
                </div>
                <h4 data-aos="fade-down" data-aos-duration="1000">{{ isset($data) ? $data['HowItWorksSection']['Subtitle'] : 'Your Journey Begins in Just a Few Steps.' }}</h4>
                <div class="row g-5">
                    <div class="col-lg-8" data-aos="fade-right" data-aos-duration="1000">
                        <div class="points-main">
                            <div class="single-point">
                                <div>
                                    <span>01</span>
                                </div>
                                <div class="single-point-text">
                                    <h5>{{ isset($data) ? $data['HowItWorksSection']['Steps']['Step 1']['Title'] : 'Create your account with us.' }}</h5>
                                    <p>{!! isset($data) ? $data['HowItWorksSection']['Steps']['Step 1']['Description'] : 'Sign up using your email and basic information to get started.' !!}</p>
                                </div>
                            </div>
                            <div class="single-point">
                                <div>
                                    <span>02</span>
                                </div>
                                <div class="single-point-text">
                                    <h5>{{ isset($data) ? $data['HowItWorksSection']['Steps']['Step 2']['Title'] : 'Submit you documents & get verified by embassy.' }}</h5>
                                    <p>{!! isset($data) ? $data['HowItWorksSection']['Steps']['Step 2']['Description'] : 'Upload required documents securely and wait for quick embassy verification.' !!}
                                    </p>
                                </div>
                            </div>
                            <div class="single-point">
                                <div>
                                    <span>03</span>
                                </div>
                                <div class="single-point-text">
                                    <h5>{{ isset($data) ? $data['HowItWorksSection']['Steps']['Step 3']['Title'] : 'Explore different benefit with us.' }}</h5>
                                    <p>{!! isset($data) ? $data['HowItWorksSection']['Steps']['Step 3']['Description'] : 'Access exclusive services, community support, and cultural programs.' !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-lg-block d-none" data-aos="fade-left" data-aos-duration="1000">
                        <div class="journey-right-area" style="background-image: url('{{ isset($data) ? $data['HowItWorksSection']['Background Image'] : 'assets/images/templates/card-img-5.svg' }}');
                        background-size: cover;
                        background-repeat: no-repeat;
                        height: 100%;
                        border-radius: 4px;
                        position: relative;">
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
                <a href="{{ isset($data) ? $data['HowItWorksSection']['Register Now Button']['Url'] : '#' }}"
                    data-bs-toggle="modal"
                    data-bs-target="#joinAs"
                    class="btn journey-begins-btn"
                    data-aos="fade-up"
                    data-aos-duration="1000">
                    {{ isset($data) ? $data['HowItWorksSection']['Register Now Button']['Text'] : 'Register Now' }}
                    <img src="assets/images/templates/right-arrow.svg" alt="right-arrow" class="img-fluid invert-img">
                </a>
            </div>
        </div>
    </section>

    <section class="event-sec">
        <div class="container">
            <div class="event-top mb-4" data-aos="fade-down" data-aos-duration="1000">
                <img src="{{ isset($data) ? $data['EventsSection']['Title Icon'] : 'assets/images/templates/ambsdr-icons-Group.svg' }}" alt="" class="img-fluid">
                <span class="ms-2">{{ isset($data) ? $data['EventsSection']['Title'] : 'Upcoming events' }}</span>
                <h3>
                    {!! isset($data)
                    ? $data['EventsSection']['Subtitle']
                    : 'Events That Connect.<span>Inspire.
                        Elevate.</span>' !!}
                </h3>
            </div>
            <div class="row g-3">
                @foreach($events as $event)
                <div class="col-lg-4" data-aos="fade-right" data-aos-duration="1000">
                    <div class="single-card">
                        <div class="event-image-container">
                            <img src="{{ asset('storage/' . $event->images->first()?->path) }}" alt="Upcoming Event" class="event-image">
                        </div>
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
                    <a href="{{ isset($data) ? $data['EventsSection']['View More Events Button']['Url'] : '#' }}"
                        class="btn btn-view-more">
                        {{ isset($data) ? $data['EventsSection']['View More Events Button']['Text'] : 'View More' }}
                        <img src="assets/images/templates/right-arrow.svg" alt="right-arrow" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection