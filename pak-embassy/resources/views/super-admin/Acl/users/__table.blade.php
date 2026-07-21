<div class="col-md-12">
    <div class="table-responsive view-table">
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th>Sr: <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="name">Name <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="email">Email <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="phone">Phone Number <img class="sort-arrow" src="images/sort-arrow.svg"
                                      alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="nid">NID <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="department">Department <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="role">Role<img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th>Created At<img class="sort-arrow" src="images/sort-arrow.svg"
                                   alt="Sort Arrow">
                </th>

                <th class="sortable" data-sort="status">Status <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th>
                    <div>
                        Action <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">

                    </div>
                </th>
            </tr>

            </thead>
            <tbody id="usersTable">
                @forelse($users as $index => $user)
                    <tr id="user-{{ $user->id }}">
                        <td class="sr-number">{{ $users->firstItem() + $index }}</td>
                        <td class="user-name">{{ $user->name }}</td>
                        <td class="user-email">{{ $user->email }}</td>
                        <td class="user-phone">{{ $user->phone }}</td>
                        <td class="user-nid">{{ str_repeat('*', max(0, strlen($user->nid) - 4)) . substr($user->nid, -4) }}</td>
                        <td class="user-department">{{ $user?->department?->name ?? "-" }}</td>
                        <td class="user-role">{{ $user->roles->first()?->name }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        @if($user->is_active)
                            <td><span class="badge bg-success-2 p-2">Active</span></td>
                        @else
                            <td><span class="badge bg-danger p-2">Pending</span><td>
                        @endif
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
                                            data-bs-target="#exampleModalToggle4"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-phone="{{ $user->phone }}"
                                            data-nid="{{ $user->nid }}"
                                            data-department="{{ $user->department_id }}"
                                            data-role="{{ $user->roles->first()?->name }}">
                                            <img src="{{ asset('images/edit.svg') }}" class="me-2" alt="edit-icon">Edit
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
                @empty
                    <tr id="no-record-row">
                        <td colspan="16" class="text-center">No record found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<x-pagination :items="$users" />

@include('super-admin.Acl.users.modal')
