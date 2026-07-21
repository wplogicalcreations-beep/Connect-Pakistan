@extends('layouts.master')

@section('content')
<div class="page-content">
    <div class="page-title">
        <h3>Matchmaking Report</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            <div class="col-12 col-md-9 ps-4">
                <x-filter-search-box tableId="matchTable" paginationContainer="pagination-container" />
            </div>
            <div class="col-12 col-md-3 text-end my-3 mt-md-0 d-flex gap-2 flex-wrap">
                <button type="button"
                    class="btn btn-outline-secondary border-2 button-style flex-fill">Excel</button>
                <button type="button"
                    class="btn btn-outline-secondary border-2 button-style flex-fill">PDF</button>
                <button type="button"
                    class="btn btn-outline-secondary border-2 button-style flex-fill">Print</button>
            </div>

            <div class="col-md-12">
                <div class="table-responsive view-table">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center sort-column" data-sort="string">Sr:  <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                                </th>
                                <th class="text-center sort-column" data-sort="string">Individual Name  <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                                </th>
                                <th class="text-center sort-column" data-sort="string">Company Name  <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                                </th>
                                <th class="text-center sort-column" data-sort="string">Skill Match  <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                                </th>
                                <th class="text-center sort-column" data-sort="string">Industry  <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                                </th>
                                <th class="text-center sort-column" data-sort="string">Domain<img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th class="text-center sort-column" data-sort="string">Match Date <a href="javascript:void(0);"
                                class="sort" data-sort="id"><img class="sort-arrow" src="{{asset('images/sort-arrow.svg')}}"
                                    alt="Sort Arrow"></a>
                                </th>


                                <th class="text-center sort-column" data-sort="string">Status <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>

                            </tr>

                        </thead>
                        <tbody id="matchTable">
                            @forelse($data as $key => $match)
                            @include('super-admin.reports.match-making.single-match-making-row', [
                            'match' => $match,
                            'serialNumber' => $data->firstItem() + $key
                            ])
                            @empty
                            <tr>
                                <td colspan="16" class="text-center">No record found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<x-pagination :items="$data" />
@endsection
@section('js-file')
<script> let table_id = "matchTable"</script>
<script src="{{ asset('js/pagination-util.js') }}"></script>
@endsection