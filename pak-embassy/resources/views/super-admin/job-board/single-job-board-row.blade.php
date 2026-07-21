<tr id="job-board-{{ $job->id }}">
    <td class="sr-number">{{ $serialNumber }}</td>
    <td class="company-name">{{ $job->organization?->name }}</td>
    <td class="title-name">{{ $job->title }}</td>
    <td class="job-type">{{ $job->job_type == 'full_time' ? 'Full-Time' : 'Part-Time' }}</td>
    <td class="work-mode">{{ $job->work_mode }}</td>
    <td class="expert-level">{{ $job->expert_level ?? 'Mid-Level' }}</td>
    <td class="posting-date">{{ $job->posted_date ? \Carbon\Carbon::parse($job->posted_date)->format('d M Y') : 'N/A' }}</td>
    @php
        $statusName = $job->status?->name ?? 'Active';

        $badgeClass = match (strtolower($statusName)) {
            'active'  => 'bg-success-2',
            'closed'  => 'bg-danger',
            'pending' => 'bg-warning text-dark',
            'draft'   => 'bg-secondary',
            default   => 'bg-info',
        };
    @endphp
    <td class="job-status">
        <span class="badge {{ $badgeClass }} p-2">{{ $statusName }}</span>
    </td>
    <td>
        <div class="dropdown">
            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
                Select
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                    data-bs-target="#changeStatusModal" onclick="openStatusModal({{ $job->id }}, {{ $job->status_id }})"><img src="images/edit.svg"
                                                            class="me-2" alt="Edit-icon">Edit </a></li>
            </ul>
        </div>
    </td>
</tr> 