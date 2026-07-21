@extends('dashboard-layouts.user-layout.master')

@section('content')
    <form class="row g-2 justify-content-end" id="jobFilterForm" method="GET" action="">

        <!-- Filter + Search -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('user-dash-img/filter-icon.svg') }}" alt="Filter Icon"> Title
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Title</a></li>
                </ul>
                <input type="text" class="form-control" name="title" value="{{ request('title', old('title')) }}"  placeholder="Search"
                    aria-label="Search input with dropdown button">
            </div>
        </div>

        <!-- Job Category -->
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
            <select class="form-control bg-category-icon" id="job_domain_id" name="domain_name">
                <option value="" disabled {{ old('domain_name', request('domain_name')) ? '' : 'selected' }}>
                    Choose Job Category
                </option>
                @foreach($domains as $domain)
                    <option 
                        value="{{ $domain->name }}" 
                        {{ old('domain_name', request('domain_name')) == $domain->name ? 'selected' : '' }}>
                        {{ $domain->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Job Type -->
        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <select class="form-control bg-type-single" id="job-type" name="job_type">
                <option value="" disabled {{ old('job_type', request('job_type')) ? '' : 'selected' }}>
                    Choose Job Type
                </option>
                @foreach($jobPosts as $jobPostIndex => $jobPost)
                    <option 
                        value="{{ $jobPostIndex }}" 
                        {{ old('job_type', request('job_type')) == $jobPostIndex ? 'selected' : '' }}>
                        {{ $jobPost }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Job Location -->
        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <input type="text" class="form-control bg-location-icon" name="location" value="{{ request('location', old('location')) }}" placeholder="Job Location">
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-1">
            <a href="{{ url('/company/create/job') }}"
                class="btn btn-common-bg add-new-event-btn w-sm-100">
                Search
            </a>
        </div>

    </form>
<!-- Event Section -->
<section class="event-sec">
    <div class="container">
        <div class="row g-3" id="job-list">
            @include('user-dashboard.job-board.partials.jobs_list', ['jobs' => $jobs])
        </div>

        @if ($jobs->hasMorePages())
        <div class="row mt-4" id="loadMoreJobs">
            <div class="col-md-12 text-center">
                <button type="button" data-page="2" data-url = "{{ route('jobs.list') }}" data-target="#job-list" class="btn btn-common-bg load-more">Load More</button>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
@section('js-file')
<script> let $form = $('#jobFilterForm'); </script>
<script> let result = $('#job-list'); </script>
<script> let loadmore = $('#loadMoreJobs'); </script>
<script src="{{ asset('js/common.js') }}"></script>
@endsection