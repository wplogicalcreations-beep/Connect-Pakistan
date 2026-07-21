<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <title>Home Page</title>
</head>

<body>
    <form action="{{ route('save-template-setting') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <button class="btn btn-theme rounded-0"
            style=" display: block;
                        margin-left: auto;width:100%; background-color: #198754; color:white"
            type="submit">PUBLISH
        </button>

        <!-- pages -->
        <!-- @if($pages && $pages->count() > 0)
            @foreach($pages as $page)             
                <a
                    class="btn {{ $current_page == $page->name ? 'btn-warning' : 'btn-secondary' }} mt-3 mb-3"
                    href="{{ route('template-setting',['id' => $template->id, 'page' => $page->name]) }}"
                    >
                    {{ formatPageName($page->name) }}
                </a>
            @endforeach
        @endif -->

        <!-- tempate id -->
        <input required type="hidden" name="template_id" value="{{ $template->id }}">
        
        <!-- page name -->
        <input required type="hidden" name="name" value="{{ $current_page_setting?->name }}"> 
        <main class="embassy-main-wrapper">
            @include('super-admin.template.template-navbar')

            <!-- Navbar -->
            {{-- <nav class="navbar navbar-light bg-light offcanvas_nav">
            <div class="container">
                <a class="navbar-brand" href="#">
                <img src="{{asset('assets/images/templates/embassy-of-PK 1.svg')}}" alt="logo" class="img-fluid')}}">
                </a>

                <!-- Offcanvas toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Offcanvas menu -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
                    Sign In <img src="{{asset('assets/images/templates/right-arrow.svg')}}" alt="right-arrow" class="img-fluid">
                    </button>
                </div>
                </div>
            </div>
        </nav> --}}

            @php
                $template = $current_page_setting?->template_page;
            @endphp

            @if($template && View::exists('super-admin.template.' . $template))
                @include('super-admin.template.' . $template)
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-4" role="alert">
                    <strong class="font-bold">Template Missing!</strong>
                    <span class="block sm:inline">
                        Blade file not found: 
                        <code class="bg-gray-100 px-1 rounded">super-admin.template.{{ $template }}.blade.php</code>
                    </span>
                </div>
            @endif

            @include('super-admin.template.template-emp-sec')


            @include('super-admin.template.setting.general-modal')

            @include('super-admin.template.template-footer')
        </main>
    </form>
    <!-- ✅ jQuery (MUST be first) -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}

    <!-- ✅ Bootstrap 5 -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}

    {{-- <!-- ✅ Slick Carousel JS (MUST be after jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}

    <!-- ✅ AOS Animation -->
    {{-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script> --}}

    <!-- ✅ Initialize AOS and Slick AFTER all libraries loaded -->
    <script>
    // Wait for entire window to load (not just DOM) to ensure all scripts are available
    // window.onload = function () {
        

    //     // ✅ Check and Init Slick only if plugin is available
    //     if (typeof $.fn.slick !== 'undefined') {
    //         if (!$('.strengh-ties').hasClass('slick-initialized')) {
    //             $('.strengh-ties').slick({
    //                 dots: true,
    //                 arrows: false,
    //                 autoplay: true,
    //                 autoplaySpeed: 3000,
    //                 infinite: true,
    //                 speed: 500,
    //                 slidesToShow: 1,
    //                 slidesToScroll: 1
    //             });
    //         }
    //     } else {
    //         console.error("⚠️ Slick is not loaded. Check your script tag.");
    //     }
    // };
    AOS.init();
</script>

</body>

</html>
@section('js-file')
    @include('super-admin.template.setting.template-page-settings-js')
@endsection
