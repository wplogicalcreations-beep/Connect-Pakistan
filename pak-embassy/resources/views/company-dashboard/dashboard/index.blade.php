@extends('dashboard-layouts.company-layout.master')
@section('content')
    <div>
        <!-- charts  -->
        @include('company-dashboard.dashboard.cards')
            <!-- Events -->
                @include('company-dashboard.dashboard.events')
    </div>
@endsection
@section('js-file')
@endsection

