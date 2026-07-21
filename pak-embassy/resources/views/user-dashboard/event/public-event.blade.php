@extends('dashboard-layouts.user-layout.master')

@section('content')
    <form class="row g-2" method="GET" action="" id="eventFilterForm">

        <!-- Filter + Search Input -->
        <div class="col-12 col-md-6 col-lg-6">
            <div class="input-group drop-buttons">
                <button class="btn btn-outline-secondary dropdown-toggle filter-button" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('user-dash-img/filter-icon.svg') }}" alt="Filter Icon"> Name
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Name</a></li>
                </ul>
                <input 
                    type="text" 
                    class="form-control search-input" 
                    name="name" 
                    value="{{ request('name') }}" 
                    placeholder="Search"
                    aria-label="Search input with dropdown button">
            </div>
        </div>

        <!-- Location Input -->
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
            <input 
                type="text" 
                class="form-control bg-location-icon" 
                name="location" 
                value="{{ request('location') }}" 
                placeholder="Location">
        </div>

        <!-- Date Input -->
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
            <input 
                type="text" 
                class="form-control bg-date-single" 
                name="start_date" 
                id="date" 
                value="{{ request('start_date') }}" 
                placeholder="Date">
        </div>
    </form>
<!-- Event Section -->
<section class="event-sec">
    <div class="container">
        <div class="row g-3" id="event-list">
            @include('user-dashboard.event.partials.events_list', ['events' => $events])
        </div>

        @if ($events->hasMorePages())
        <div class="row mt-4" id="loadMoreJobs">
            <div class="col-md-12 text-center">
                <button type="button" data-page="2" data-url="{{ request()->fullUrl() }}" data-target="#event-list" class="btn btn-common-bg load-more">Load More</button>
            </div>
        </div>
        @endif
    </div>

</section>
@endsection
@section('js-file')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script> let $form = $('#eventFilterForm'); </script>
<script> let result = $('#event-list'); </script>
<script> let loadmore = $('#loadMoreJobs'); </script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/event.js') }}"></script>
@endsection