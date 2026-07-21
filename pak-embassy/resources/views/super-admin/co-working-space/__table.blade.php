<div class="col-md-12">
    <div class="table-responsive view-table cow-worker-table">
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th class="sortable" data-sort="space-id">Space ID <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-name">Title <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-email">Email <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-phone">Phone Number <img class="sort-arrow" src="images/sort-arrow.svg"
                                      alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-price">Starting Price <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-rental">Month Rentals<img class="sort-arrow" src="images/sort-arrow.svg"
                                      alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-people">No. of Seats <img class="sort-arrow" src="images/sort-arrow.svg"
                                alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="new-requests">New Requests <img class="sort-arrow" src="images/sort-arrow.svg"
                                alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="space-action">Action <img class="sort-arrow" src="images/sort-arrow.svg"
                                alt="Sort Arrow">
                </th>

            </tr>

            </thead>
            <tbody id="coWorkingSpaceTable">
                @forelse($coWorkingSpaces as $space)
                    <tr id="space-{{ $space->id }}">
                        <td class="space-id">{{ $space->space_id ?? '-' }}</td>
                        <td class="space-name">{{ $space->name }}</td>
                        <td class="space-email">{{ $space->email }}</td>
                        <td class="space-phone">{{ $space->phone }}</td>
                        <td class="space-price">SAR {{ $space->starting_price }}</td>
                        <td class="space-rental">{{ $space->month_rentals }} Months</td>
                        <td class="space-people text-center">{{ $space->people }}</td>
                        <td class="new-requests text-center">
                            @if($space->newRequestsCount() > 0)
                                <span class="badge bg-warning text-dark p-2">{{ $space->newRequestsCount() }}</span>
                            @else
                                <span class="text-muted">0</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Select
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" 
                                            href="{{ route('co-working-space.show',['space' => $space->id]) }}">
                                            <img src="images/Bookings.svg" class="me-2" alt="View-icon">View 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" 
                                            href="{{ route('co-working-space.requests', $space) }}">
                                            <img src="images/Bookings.svg" class="me-2" alt="Requests-icon">Requests 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No record found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<x-pagination :items="$coWorkingSpaces" />

@include('super-admin.co-working-space.modal')
