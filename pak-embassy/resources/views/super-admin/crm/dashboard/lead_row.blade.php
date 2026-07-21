<tr>
    <td class="td-name">{{ $user->name }}</td>
    <!-- <td class="td-lead-id">{{ $user->lead_id ?? 'N/A' }}</td> -->
    <td class="td-lead-type">{{ $user->lead_type ?? 'Startup' }}</td>
    <td class="td-email">{{ $user->email }}</td>
    <td class="td-phone">{{ $user->phone }}</td>
    <td class="td-department">{{ $user->work_domain?->first()?->name ?? 'Fintech' }}</td>
    <td class="td-created-at">{{ $user->created_at->format('d M,Y') }}</td>
    <td class="td-status">
        @if($user->is_active == '1')
            <span class="badge bg-success p-2">Approved</span>
        @else
            <span class="badge bg-info p-2">Pending</span>
        @endif
    </td>
    <td>
        <div class="dropdown">
            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Select
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('dashboard.leads.view', $user->id) }}">
                        <i class="fa-regular fa-eye me-2"></i>View
                    </a>
                </li>
                <!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="images/edit.svg" class="me-2" alt="Edit-icon">Edit </a></li>
                <li>
                    <a class="dropdown-item" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><img src="images/delete-icon.svg" class="me-2" alt="delete-icon">Delete</a>
                </li> -->
            </ul>
        </div>
    </td>
</tr>