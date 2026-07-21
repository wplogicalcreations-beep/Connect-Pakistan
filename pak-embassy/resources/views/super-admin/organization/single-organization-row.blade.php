<tr id="organization-user-{{ $org->id }}">
    <td class="sr-number">{{ $serialNumber }}</td>
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