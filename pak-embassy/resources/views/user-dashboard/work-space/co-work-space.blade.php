@extends('dashboard-layouts.user-layout.master')

@section('content')
<div class="row g-2 justify-content-end">

        <!-- Filter + Search Input -->
        <x-filter-search-box tableId="work-space-list" paginationContainer="pagination-container" />

    </div>
<!-- Event Section -->
<section class="event-sec">
    <div class="container-fluid">
        <div class="row g-4" id="work-space-list">
            @include('user-dashboard.work-space.partials.single-coworking-space', ['coworkingSpaces' => $coworkingSpaces])
        </div>
         @if ($coworkingSpaces->hasMorePages())
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <button type="button" data-page="2" data-url = "{{ route('co-work-space.list') }}" data-target="#work-space-list" class="btn btn-common-bg load-more">Load More</button>
            </div>
        </div>
        @endif
    </div>

</section>
@endsection
@section('js-file')
<script src="{{ asset('js/common.js') }}"></script>
@endsection
