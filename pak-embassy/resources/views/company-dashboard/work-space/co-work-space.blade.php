@extends('dashboard-layouts.company-layout.master')

@section('content')
<div class="row mt-5 g-2 justify-content-end">
    <!-- Filter + Search Input -->
    <x-filter-search-box tableId="company-work-space-list" paginationContainer="pagination-container" />
</div>

<!-- Event Section -->
<section class="event-sec">
    <div class="container-fluid">
        <div class="row g-4" id="company-work-space-list">
            @include('company-dashboard.work-space.partials.single-coworking-space', ['coworkingSpaces' => $coworkingSpaces])
        </div>
        @if ($coworkingSpaces->hasMorePages())
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <button type="button" data-page="2" data-url="{{ route('company.co-work-space.list') }}" data-target="#company-work-space-list" class="btn btn-common-bg load-more">Load More</button>
            </div>
        </div>
        @endif
    </div>

</section>
@endsection
@section('js-file')
<script src="{{ asset('js/common.js') }}"></script>
@endsection