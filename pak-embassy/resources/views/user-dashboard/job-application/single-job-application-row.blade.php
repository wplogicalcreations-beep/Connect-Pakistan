<tr id="jobApplications-{{ $jobApplication->id }}">
    <td class="sr-number">{{ $serialNumber }}</td>
    <td class="text-center dept-name">{{ $jobApplication->jobPost->organization->name ?? '-' }}</td>
    <td class="text-center dept-name">{{ $jobApplication->jobPost->title ?? '-' }}</td>
    <td class="text-center dept-name">{{ $jobApplication->jobPost->job_type ?? '-' }}</td>
    <td class="text-center dept-name">{{ $jobApplication->jobPost->work_mode ?? '-' }}</td>
    <td class="text-center dept-name">{{ $jobApplication->jobPost->level ?? '-' }}</td>
    <td class="text-center dept-name">{{ $jobApplication->jobPost->status->name ?? 'Pending' }}</td>

    <!-- <td>
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
                            data-id="{{ $jobApplication->id }}"
                            data-name="{{ $jobApplication->name }}">
                            <img src="{{ asset('images/edit.svg') }}" class="me-2" alt="edit-icon">Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item delete-jobApplication" href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModalToggle"
                            data-id="{{ $jobApplication->id }}">
                            <img src="{{ asset('images/delete-icon.svg') }}" class="me-2" alt="delete-icon">Delete
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </td> -->
</tr>