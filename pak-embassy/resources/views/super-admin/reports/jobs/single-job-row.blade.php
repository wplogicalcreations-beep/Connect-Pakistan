<tr>
    <td>{{ $serialNumber }}</td>
    <td>{{ $job['company_name'] }}</td>
    <td>{{ $job['location'] }}</td>
    <td>{{ $job['post_date'] ? \Carbon\Carbon::parse($job['post_date'])->format('d/m/Y') : '-' }}</td>
    <td>{{ $job['total_applicants'] }}</td>
    <td>{{ $job['deadline'] ? \Carbon\Carbon::parse($job['deadline'])->format('d/m/Y') : '-' }}</td>
    <td class="text-end">
        <span class="badge {{ $job['status'] == 'active' ? 'bg-success-2' : 'bg-danger-2' }} p-2">
            {{ ucfirst($job['status']) }}
        </span>
    </td>
</tr>