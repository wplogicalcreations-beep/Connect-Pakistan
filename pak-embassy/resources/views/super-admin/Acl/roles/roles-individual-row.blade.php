<tr id="role-{{ $role->id }}">
    <td class="sr-number"></td>
    <td class="role-name">{{ $role->name }}</td>
    <td class="role-permissions">
        @php
            $permissions = $role->permissions->pluck('name')->map(fn($name) => str_replace('_', ' ', $name))->toArray();
            $permissionsJson = json_encode($permissions);
        @endphp
        <button type="button" 
                class="btn btn-sm btn-outline-primary view-permissions-btn" 
                data-bs-toggle="modal"
                data-bs-target="#viewPermissionsModal"
                data-role-name="{{ $role->name }}"
                data-permissions='{{ $permissionsJson }}'
                data-permission-count="{{ count($permissions) }}">
            <span class="badge bg-primary">{{ count($permissions) }}</span> Permission{{ count($permissions) !== 1 ? 's' : '' }}
        </button>
    </td>
    <td class="role-status">
        @if($role->status)
            <span class="badge bg-success-2 p-2">Active</span>
        @else
            <span class="badge bg-danger p-2">In-Active</span>
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
                    <a class="dropdown-item" href="#" 
                    data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop"
                    data-id="{{ $role->id }}"
                    data-name="{{ $role->name }}"
                    data-status="{{ $role->status }}">
                        <img src="{{ asset('images/edit.svg') }}" class="me-2" alt="Edit-icon">Edit
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" 
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModalToggle"
                    data-id="{{ $role->id }}">
                        <img src="{{ asset('images/delete-icon.svg') }}" class="me-2" alt="Delete-icon">Delete
                    </a>
                </li>
            </ul>
        </div>
    </td>
</tr>