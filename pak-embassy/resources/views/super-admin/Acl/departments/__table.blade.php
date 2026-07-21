<div class="col-md-12">
    <div class="dep-list-table">
        <div class="table-responsive view-table">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                <tr>
                    <th class="sort-column" data-sort="number">Sr: <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                    </th>
                    <th class="text-center sort-column" data-sort="string">Department <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                    <th>                                            Action <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                    </th>
                </tr>
                </thead>
                <tbody id="departmentsTable">
                    @forelse($departments as $index => $department)
                        <tr id="department-{{ $department->id }}">
                            <td class="sr-number">{{ $departments->firstItem() + $index }}</td>
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
                    @empty
                        <tr id="no-record-row">
                            <td colspan="16" class="text-center">No record found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-pagination :items="$departments" />
@include('super-admin.Acl.departments.modal')
