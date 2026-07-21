<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('img/embassy-logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/join-as.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
    <!-- new -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    
    <title>@yield('title', 'Embassy')</title>
</head>

<body>
    <main class="embassy-main-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light nav_desktop">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ isset($data) ? $data['Logo'] : 'assets/images/templates/embassy-of-PK 1.svg' }}" alt="logo" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse side-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ isset($data) ? $data['NavbarSection']['Home']['url'] : '#' }}">{{ isset($data) ? $data['NavbarSection']['Home']['Text'] : 'Home' }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ isset($data) ? $data['NavbarSection']['Portal']['url'] : '#' }}">{{ isset($data) ? $data['NavbarSection']['Portal']['Text'] : 'Portal' }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ isset($data) ? $data['NavbarSection']['Knowledge Base']['url'] : '#' }}">{{ isset($data) ? $data['NavbarSection']['Knowledge Base']['Text'] : 'Knowledge Base' }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ isset($data) ? $data['NavbarSection']['Job Notice Board']['url'] : '#' }}">{{ isset($data) ? $data['NavbarSection']['Job Notice Board']['Text'] : 'Job Notice Board' }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ isset($data) ? $data['NavbarSection']['Events']['url'] : '#' }}">{{ isset($data) ? $data['NavbarSection']['Events']['Text'] : 'Events' }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ isset($data) ? $data['NavbarSection']['Contact US']['url'] : '#' }}">{{ isset($data) ? $data['NavbarSection']['Contact US']['Text'] : 'Contact US' }}</a>
                        </li>


                    </ul>
                    @php
                        $signInUrl = $data['NavbarSection']['Sign In Button']['url'] ?? route('login');

                        if ($signInUrl !== '#' && !filter_var($signInUrl, FILTER_VALIDATE_URL)) {
                            $signInUrl = route($signInUrl);
                        }
                    @endphp

                    <a href="{{ $signInUrl }}" class="btn btn-right-arrow">
                        {{ $data['NavbarSection']['Sign In Button']['Text'] ?? 'Sign In' }}

                        <img src="{{ asset('assets/images/templates/right-arrow.svg') }}" alt="right-arrow" class="img-fluid">
                    </a>
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

        <!-- content -->
         @yield('content')

        <section class="empowering-sec">
            <div class="container">
                <div class="empowering-wrapper" style="background-image: url('{{ isset($data) ? $data['CallToAction']['Background Image'] : 'assets/images/templates/banner-bg.png' }}');
                    background-size: cover;
                    background-repeat: no-repeat;
                    height: 460px;
                    text-align: center;
                    color: #fff;
                    padding: 104px 88px;
                    margin-bottom: 3rem;">
                    <div data-aos="fade-right" data-aos-duration="1000">
                        <h2>{{ isset($data) ? $data['CallToAction']['Title'] : 'Empowering You to Grow in KSA — One Click Away.' }}</h2>
                        <p>{!! isset($data) ? $data['CallToAction']['Description'] : 'Create your account today and become part of a trusted, embassy-backed platform connecting
                            Pakistani talent and businesses across KSA.' !!}</p>
                    </div>
                    <a href="{{ isset($data) ? $data['CallToAction']['Get Started Now Button']['Url'] : '#' }}"
                        data-bs-toggle="modal"
                        data-bs-target="#joinAs"
                        class="btn journey-begins-btn"
                        data-aos="fade-right"
                        data-aos-duration="1000">
                        {{ isset($data) ? $data['CallToAction']['Get Started Now Button']['Text'] : 'Get Started Now' }}
                    </a>
                </div>
            </div>
        </section>

        <footer>
            <div class="container top-contianer">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-logo-area">
                            <img src="{{ isset($data) ? $data['FooterSection']['Title Icon'] : 'assets/images/templates/footer-logo.png' }}" alt="" class="img-fluid">
                            {{-- <img src="{{ isset($data) ? $data['FooterSection']['Map']['Title Icon'] : 'assets/images/templates/footer-map.png' }}" alt=""
                            class="img-fluid map-icon"> --}}
                        </div>
                        <p class="footer-text">{!! isset($data) ? $data['FooterSection']['Description'] : 'Empowering the Pakistani Diaspora, Enabling Progress Through Innovation,
                            Partnership, and Opportunity.' !!}</p>

                        <div class="footer-social-items">
                            <a href=""> <img src="assets/images/templates/facebook-f.svg" alt=""></a>
                            <a href=""> <img src="assets/images/templates/instagram.svg" alt=""></a>
                            <a href=""> <img src="assets/images/templates/x-icon.svg" alt=""></a>
                            <a href=""><img src="assets/images/templates/linkedin-in.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="useful-links">
                            <h6>{{ isset($data) ? $data['FooterSection']['Useful Links']['Title'] : 'Useful Link' }}</h6>
                            <ul>
                                <li><a href="{{ isset($data) ? $data['FooterSection']['Useful Links']['Portal']['url'] : '#' }}"><img src="{{ isset($data) ? $data['FooterSection']['Useful Links']['Portal']['Icon'] : 'assets/images/templates/footer-arrow.png' }}"
                                            alt=""> {{ isset($data) ? $data['FooterSection']['Useful Links']['Portal']['Text'] : 'Portal' }}</a></li>
                                <li><a href="{{ isset($data) ? $data['FooterSection']['Useful Links']['Knowledge Base']['url'] : '#' }}"><img src="{{ isset($data) ? $data['FooterSection']['Useful Links']['Knowledge Base']['Icon'] : 'assets/images/templates/footer-arrow.png' }}"
                                            alt=""> {{ isset($data) ? $data['FooterSection']['Useful Links']['Knowledge Base']['Text'] : 'Knowledge Base' }}</a></li>
                                <li><a href="{{ isset($data) ? $data['FooterSection']['Useful Links']['Job Notice Board']['url'] : '#' }}"><img src="{{ isset($data) ? $data['FooterSection']['Useful Links']['Job Notice Board']['Icon'] : 'assets/images/templates/footer-arrow.png' }}"
                                            alt=""> {{ isset($data) ? $data['FooterSection']['Useful Links']['Job Notice Board']['Text'] : 'Job Notice Board' }}</a>
                                </li>
                                <li><a href="{{ isset($data) ? $data['FooterSection']['Useful Links']['Events']['url'] : '#' }}"><img src="{{ isset($data) ? $data['FooterSection']['Useful Links']['Events']['Icon'] : 'assets/images/templates/footer-arrow.png' }}"
                                            alt=""> {{ isset($data) ? $data['FooterSection']['Useful Links']['Events']['Text'] : 'Events' }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="news-letter">
                            <h6>{{ isset($data) ? $data['FooterSection']['Newsletter']['Title'] : 'Subscribe Our Newsletter' }}</h6>
                            <p>{!! isset($data) ? $data['FooterSection']['Newsletter']['Description'] : 'Find Your News, Settle Your Mind — Every Story Curated for Your Peace of Mind.' !!}</p>
                            <div class="news-email">
                                <input type="email" placeholder="Enter Email" class="form-control">
                                <button class="btn email-send-btn "><img src="{{ isset($data) ? $data['FooterSection']['Newsletter']['Title Icon'] : 'assets/images/templates/email-icon.svg' }}"
                                        alt=""></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="copy-rights">

                    <p>{!! isset($data) ? $data['FooterSection']['Bottom']['Description'] : '© Pakistan-Saudi Arabia Embassy 2025 | All Rights Reserved' !!}</p>
                    <ul>
                        <li> <a href="{{ isset($data) ? $data['FooterSection']['Links']['Terms & Conditions']['url'] : '#' }}">{{ isset($data) ? $data['FooterSection']['Links']['Terms & Conditions']['Text'] : 'Terms & Conditions' }}</a></li>
                        <li><a href="{{ isset($data) ? $data['FooterSection']['Links']['Privacy Policy']['url'] : '#' }}">{{ isset($data) ? $data['FooterSection']['Links']['Privacy Policy']['Text'] : 'Privacy Policy' }}</a></li>
                        <li><a href="{{ isset($data) ? $data['FooterSection']['Links']['Contact Us']['url'] : '#' }}">{{ isset($data) ? $data['FooterSection']['Links']['Contact Us']['Text'] : 'Contact Us' }}</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </main>
    @include('joinAs')








    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- slick slider -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="{{asset('assets/slick.js')}}"></script>
</body>

</html>