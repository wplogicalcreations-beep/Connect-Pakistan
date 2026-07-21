@extends('layouts.master')
<link rel="stylesheet" href="{{asset('css/apex-chart.css')}}">
@section('content')
    <div>
        <!-- charts  -->
        @include('super-admin.dashboard.cards')
        <!-- Events -->
        @include('super-admin.dashboard.events')
    </div>
@endsection
@section('js-file')
<script>
    var data = <?php echo json_encode($data); ?>;
</script>
<script src="{{ asset('js/apex-chart.js') }}"></script>
<script src='{{ asset('js/apex-common.js') }}'> </script>
@endsection
