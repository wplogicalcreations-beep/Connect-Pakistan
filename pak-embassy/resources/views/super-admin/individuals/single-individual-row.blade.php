<tr id="skilled-individual-{{ $user->id }}">
    <td class="sr-number">{{ $serialNumber }}</td>
    <td class="user-name">{{ $user->name }}</td>
    <td class="lov-name">
        @if($user->work_domain->isNotEmpty())
            {{ $user->work_domain->first()->name }}
        @else
            N/A
        @endif
    </td>
    <td class="level-name">
        @if($user->level->isNotEmpty())
            {{ $user->level->first()->name }}
        @else
            N/A
        @endif
    </td>
    <td class="skills-name">
        @if($user->skills->isNotEmpty())
            {{ $user->skills->pluck('name')->join(', ') }}
        @else
            N/A
        @endif
    </td>
    <td class="created-at">{{ $user->created_at->format('d M Y H:i:s') }}</td>
    <td id="user-status-{{ $user->id }}" class="user-status">
        @if($user->is_active == '1')
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

                <li><a class="dropdown-item" href="{{ route('skilled_individuals.show', $user->id) }}" ><i class="fa-regular fa-eye me-2"></i>view </a></li>
                <li>
                    <a class="dropdown-item" href="{{ route('skilled_individuals.edit', $user->id) }}">
                        <img src="{{ asset('images/edit.svg') }}" class="me-2" alt="edit-icon">Edit
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="approveOrDeclineIndividual({{ $user->id }}, 'approve'); return false;">
                        <i class="fa-solid fa-circle-check me-2"></i>Approve
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="approveOrDeclineIndividual({{ $user->id }}, 'decline'); return false;">
                        <i class="fa-solid fa-circle-xmark me-2"></i>Decline
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModalToggle"
                        data-id="{{ $user->id }}">
                        <img src="{{ asset('images/delete-icon.svg') }}" class="me-2" alt="delete-icon">Delete
                    </a>
                </li>
            </ul>
        </div>
    </td>
</tr>