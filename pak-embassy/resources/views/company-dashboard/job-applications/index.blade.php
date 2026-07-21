@extends('dashboard-layouts.company-layout.master')

@section('content')
    <div class="page-title">
        <h3>Job Applications</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row" id="table-container"
             data-table-utils
             data-base-url="{{ route('company.recieved.applications') }}"
             data-table-selector="#applicationsTable"
             data-table-container-selector="#applicationsTable"
             data-pagination-container-selector=".pagination-container"
             data-search-input-selector="#searchInput"
             data-per-page-select-selector=".per-page-select, select[name='per_page']"
             data-sort-trigger-selector=".sort"
             data-param-search="name">
            @include('company-dashboard.job-applications.__filters')
            @include('company-dashboard.job-applications.__table')
        </div>
    </div>
@endsection
@section('js-file')
<script> let listing_url ="{{route('company.recieved.applications')}}"</script>
<script src="{{ asset('js/table-utils.js') }}"></script>
@endsection
