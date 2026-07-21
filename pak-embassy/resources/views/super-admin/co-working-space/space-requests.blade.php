@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="page-title">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Co-Working Space Requests</h3>
                    <p class="text-muted mb-0">Space: <strong>{{ $space->name }}</strong> ({{ $space->space_id }})</p>
                </div>
                <a href="{{ route('co-working-space.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Spaces
                </a>
            </div>
        </div>
        <div class="card border-0 py-3 px-2">
            <div class="row">
                <div class="col-12 col-md-8">
                    <x-filter-search-box tableId="spacesRequestTable" paginationContainer="pagination-container" />
                </div>
                <div class="col-12 col-md-4 text-end my-3 mt-md-0 pe-4 btn-resp">
                    <button type="button" id="exportExcel" class="btn btn-outline-secondary border-2 button-style">Excel</button>
                    <button type="button" id="exportPDF" class="btn btn-outline-secondary border-2 button-style">PDF</button>
                    <button type="button" id="exportPrint" class="btn btn-outline-secondary border-2 button-style">Print</button>
                    <button type="button" id="exportExcel" class="btn btn-common-bg">Export CSV</button>
                </div>

                <div class="col-md-12">
                    <div class="table-responsive view-table">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th class="sortable" data-sort="request-id">Request ID <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th class="sortable" data-sort="request-name">Name <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th class="sortable" data-sort="request-email">Email <img class="sort-arrow" src="images/sort-arrow.svg"
                                               alt="Sort Arrow">
                                </th>
                                <th class="sortable" data-sort="request-phone">Phone Number <img class="sort-arrow" src="images/sort-arrow.svg"
                                                      alt="Sort Arrow">
                                </th>
                                <th class="sortable" data-sort="request-company">Company Name <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th class="sortable" data-sort="request-people">No. of People <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th class="sortable" data-sort="request-starting-date">Est. Start Date<img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </th>
                                <th class="sortable" data-sort="request-status">Status <img class="sort-arrow" src="images/sort-arrow.svg"
                                                alt="Sort Arrow">
                                </th>
                                <th class="sortable" data-sort="request-action">Action <img class="sort-arrow" src="images/sort-arrow.svg"
                                                alt="Sort Arrow">
                                </th>

                            </tr>
                            </thead>
                            <tbody id="spacesRequestTable">
                                @forelse($requests as $request)
                                    @include('super-admin.co-working-space.single-space-specific-request-row', ['request' => $request])
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No requests found for this space.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-pagination :items="$requests" />
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enquiryModalLabel">Enquiry Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center mb-5 pb-5" id="enquiryModalContent">
                    <!-- HTML from controller will load here -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-file')
    <script src="{{ asset('js/SuperAdmin/spaces-request.js') }}"></script>
    <script>
        let table_id = "spacesRequestTable";
        let listing_url = "{{ route('co-working-space.requests', $space) }}";
    </script>
    <script src="{{ asset('js/pagination-util.js') }}"></script>
@endsection

