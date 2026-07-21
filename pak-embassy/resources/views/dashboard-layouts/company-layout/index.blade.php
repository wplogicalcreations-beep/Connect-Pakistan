<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Company</title>
    <link rel="icon" href="{{ asset('images/favicon-ion.png') }}" type="image/x-icon">
    {{-- <link rel="stylesheet" href="{{asset('css/user-dashboard-css/font-awesome.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/user-dashboard-css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/user-dashboard-css/jQuery-Ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/user-dashboard-css/user-dashboard.css')}}">
     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    @yield('css-file')
    <title> Company Dashboard</title>
</head>

<body>
{{--@include('layouts.loader')--}} <!-- Sidebar -->

<div class="wrapper">
    @yield('sidebar')
</div>
<div class="content">
    @include('dashboard-layouts.company-layout.navbar')
    <div class="page-content">
        @yield('content')
    </div>

</div>
@include('modals.change-passcode-modal')
</div>


<script src="{{ asset('js/user-dashboard.js/jQuery.js') }}"></script>
<script src="{{ asset('js/user-dashboard.js/bootstrap.js') }}"></script>
<script src="{{ asset('js/user-dashboard.js/font-awesome.js') }}"></script>
<script src="{{ asset('js/user-dashboard.js/jQuery-ui.js') }}"></script>
<script src="{{ asset('js/user-dashboard.js/main.js') }}"></script>
<script src="{{asset('js/user-dashboard.js/tel-script.js')}}"></script>
<script src="{{asset('js/user-dashboard.js/country-script.js')}}"></script>
<script>
    $(window).load(function () {

        $(".loading-spinner").delay(700).fadeOut("slow");
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Job Posted!',
        text: '{{ session('
        success ') }}',
        confirmButtonColor: '#198754'
    })
</script>
@endif
@yield('js-file')
</body>

</html>
