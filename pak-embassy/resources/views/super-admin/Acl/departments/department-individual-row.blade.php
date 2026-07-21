<tr id="department-{{ $department->id }}">
    <td class="sr-number">{{ $serialNumber ?? 0 }}</td>
    <td class="text-center dept-name">{{ $department->name }}</td>
    <td>
        <div>
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
                           data-id="{{ $department->id }}"
                           data-name="{{ $department->name }}">
                            <img src="{{ asset('images/edit.svg') }}" class="me-2" alt="edit-icon">Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"
                           data-bs-toggle="modal"
                           data-bs-target="#exampleModalToggle"
                           data-id="{{ $department->id }}">
                            <img src="{{ asset('images/delete-icon.svg') }}" class="me-2" alt="delete-icon">Delete
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </td>
</tr>