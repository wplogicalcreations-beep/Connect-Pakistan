@extends('layouts.master')

@section('content')
<div class="page-content">
    <div class="page-title">
        <h3>User Registration Report</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            <div class="col-12 col-md-9 ps-4">
                <x-filter-search-box tableId="usersTable" paginationContainer="pagination-container" />
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
                                <th>Sr: <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th>Name <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th>Email <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th>Phone Number <img class="sort-arrow" src="images/sort-arrow.svg"
                                        alt="Sort Arrow">
                                </th>
                                <th>User Type <img class="sort-arrow" src="images/sort-arrow.svg"
                                        alt="Sort Arrow">
                                </th>
                                <th>Registered At<img class="sort-arrow" src="images/sort-arrow.svg"
                                        alt="Sort Arrow">
                                </th>


                                <th>Status <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>

                            </tr>

                        </thead>
                        <tbody id="usersTable">
                            @forelse($data as $key => $user)
                            @include('super-admin.reports.users.single-user-row',
                            [
                                'user' => $user, 
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
<script> let table_id = "usersTable"</script>
<script> let listing_url ="{{route('users-reports.index')}}"</script>
<script src="{{ asset('js/pagination-util.js') }}"></script>
@endsection