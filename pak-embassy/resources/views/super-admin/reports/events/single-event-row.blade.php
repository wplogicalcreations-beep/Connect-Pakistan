<tr id="event-{{ $event['id'] }}">
    <td>{{ $serialNumber }}</td>
    <td>{{ $event['name'] }}</td>
    <td>{{ $event['type'] }}</td>
    <td>{{ $event['registered_users'] }}</td>
    <td>{{ $event['event_date'] ? \Carbon\Carbon::parse($event['event_date'])->format('d/m/Y') : '-' }}</td>
    <td>{{ $event['start_time'] ? \Carbon\Carbon::parse($event['start_time'])->format('h:i A') : '-' }}</td>
    <td>{{ $event['end_time'] ? \Carbon\Carbon::parse($event['end_time'])->format('h:i A') : '-' }}</td>
    <td class="text-end">
        <span class="badge {{ $event['status'] == 'Active' ? 'bg-success-2' : 'bg-danger-2' }} p-2">
            {{ ucfirst($event['status']) }}
        </span>
    </td>
</tr>