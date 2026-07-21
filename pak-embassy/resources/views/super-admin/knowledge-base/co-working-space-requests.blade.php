@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="page-title">
            <h3>Co-WorkSpace Requests</h3>
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
                                    <tr id="space-request-{{ $request->id }}">
                                        <td class="request-request-id">{{ $request->coworkingSpace?->space_id }}</td>
                                        <td class="request-space-name">{{ $request->coworkingSpace?->name }}</td>
                                        <td class="request-space-email">{{ $request->coworkingSpace?->email }}</td>
                                        <td class="request-space-phone">{{ $request->coworkingSpace?->phone }}</td>
                                        <td class="request-space-people-count">{{ $request->people_count }}</td>
                                        <td class="request-space-start-date">{{ $request->estimated_start_date }}</td>
                                        <td class="text-end request-space-status"><span class="badge bg-success-2 p-2">{{ $request->status?->name ?? 'New' }}</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); openEnquiryModal('{{ route('co-working-space.enquiry', ['id' => $request->id]) }}')">
                                                            <img src="{{ asset('images/Bookings.svg') }}" class="me-2" alt="View-icon"> View
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="16" class="text-center">No record found</td>
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
@endsection
