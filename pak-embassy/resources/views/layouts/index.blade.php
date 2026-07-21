<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}/">
    <title>Embassy</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="logs-url" content="{{ route('logs.index') }}">
    <meta name="unread-count-url" content="{{ route('logs.unread-count') }}">
    @endauth
    <link rel="icon" href="{{ asset('img/embassy-logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/jQuery-Ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/mainDashboard.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/apex-chart.css')}}">

    @yield('css-file')
    <title> Embassy Dashboard</title>
</head>

<body>
{{--@include('layouts.loader')--}} <!-- Sidebar -->

<div class="wrapper">
    @yield('sidebar')
</div>
<div class="content">
    @include('layouts.navbar')
    <div class="page-content">
        @yield('content')
    </div>

</div>
</div>

<script src="{{ asset('js/jQuery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/font-awesome.js') }}"></script>
<script src="{{ asset('js/jQuery-ui.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/apex-chart.js') }}"></script>
<script src="{{ asset('js/jQuery-ui.js') }}"></script>

<!-- SheetJS for Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<!-- jsPDF for PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(window).on('load', function () {
    $(".loading-spinner").delay(700).fadeOut("slow");
});

</script>
@auth
<script src="{{ asset('js/logs.js') }}"></script>
@endauth
@yield('js-file')
</body>

</html>
