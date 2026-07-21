<tr id="lov-{{ $lov->id }}">
    <td class="sr-numbers">{{ $serialNumber }}
    </td>
    <td class="text-center dept-name">{{ $lov->name }}</td>
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
                           data-bs-target="#lovModal"
                           data-id="{{ $lov->id }}"
                           data-name="{{ $lov->name }}"
                           data-type="{{ $lov->lovType->slug }}">
                            <img src="{{ asset('images/edit.svg') }}" class="me-2" alt="edit-icon"> Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item delete-lov"
                           href="#"
                           data-bs-toggle="modal"
                           data-bs-target="#lovDeleteModal"
                           data-id="{{ $lov->id }}"
                           data-type="{{ $lov->lovType->slug }}">
                            <img src="{{ asset('images/delete-icon.svg') }}" class="me-2" alt="delete-icon">Delete
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </td>
</tr>
