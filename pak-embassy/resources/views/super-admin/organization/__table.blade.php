<div class="col-md-12">
    <div class="table-responsive view-table">
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th>Sr: <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="name">Organization Name <img class="sort-arrow" src="images/sort-arrow.svg"
                                           alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="type">Type <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="count">Head Count <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="domain">Domain<img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="ceo-name">Name of CEO <img class="sort-arrow" src="images/sort-arrow.svg"
                                     alt="Sort Arrow">
                </th>

                <th class="sortable" data-sort="register-date">Register Date <img class="sort-arrow" src="images/sort-arrow.svg"
                                       alt="Sort Arrow">
                </th>

                <th class="sortable" data-sort="status">Status <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th>
                    Action
                </th>
            </tr>
            </thead>
            <tbody id="organizationUsersTable">
                @forelse($organizations as $index => $org)
                    <tr id="organization-user-{{ $org->id }}">
                        <td class="sr-number">{{ $organizations->firstItem() + $index }}</td>
                        <td class="org-name">{{ $org->name }}</td>
                        <td class="org-type">{{ $org->company_type }}</td>
                        <td class="org-staff">{{ $org->no_of_staff }}</td>
                        <td class="org-lovs">
                            @if($org?->ceo?->lovs?->isNotEmpty() ?? false)
                                {{ $org->ceo->lovs->pluck('name')->join(', ') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="ceo-name">{{ $org->ceo_name }}</td>
                        <td class="created_at">{{ $org->created_at->format('d M Y H:i:s') }}</td>
                        <td id="org-status-{{ $org->id }}" class="org-status">
                            @if($org->is_verified)
                                <span class="badge bg-success p-2">Approved</span>
                            @else
                                <span class="badge bg-info p-2">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                    Select
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('organizations.show', $org->id) }}" ><i class="fa-regular fa-eye me-2"></i>View </a></li>
                                <li><a class="dropdown-item" href="{{ route('organizations.edit', $org->id) }}"><img src="images/edit.svg"
                                                            class="me-2" alt="Edit-icon">Edit </a></li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="approveOrDeclineOrganization({{ $org->id }}, 'approve'); return false;">
                                        <i class="fa-solid fa-circle-check me-2"></i>Approve
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="approveOrDeclineOrganization({{ $org->id }}, 'decline'); return false;">
                                        <i class="fa-solid fa-circle-xmark me-2"></i>Decline
                                    </a>
                                </li>
                                    <li>
                                        <a class="dropdown-item" data-id="{{ $org->id }}" data-bs-toggle="modal"
                                        href="#exampleModalToggle" role="button"><img
                                                src="images/delete-icon.svg" class="me-2"
                                                alt="delete-icon">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="no-record-row">
                        <td colspan="16" class="text-center">No record found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<x-pagination :items="$organizations"/>
@include('super-admin.organization.modal')

