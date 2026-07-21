@extends('dashboard-layouts.user-layout.master')
@section("content")
    <div class="page-title">
        <h3>Job Applications</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            @include('user-dashboard.job-application.__filters')

            @include('user-dashboard.job-application.__table')
        </div>
    </div>

@endsection
@section("js-file")
<script> let listing_url ="{{route('applications.list')}}"</script>
<script src="{{ asset('js/job/job-application-listing.js') }}"></script>
@endsection
