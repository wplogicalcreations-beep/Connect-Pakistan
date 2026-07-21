<tr id="users-{{ $user['id'] }}">
    <td class="sr-number">{{ $serialNumber }}</td>
    <td>{{ $user['name'] }}</td>
    <td>{{ $user['email'] }}</td>
    <td>{{ $user['phone'] ?? '-' }}</td>
    <td>{{ $user['user_type'] }}</td>
    <td>{{ isset($user['created_at']) ? \Carbon\Carbon::parse($user['created_at'])->format('d/m/Y') : '-' }}</td>
    <td class="text-end">
        <span class="badge {{ ($user['status'] ?? 'active') == 'active' ? 'bg-success-2' : 'bg-danger-2' }} p-2">
            {{ ucfirst($user['status'] ?? 'Active') }}
        </span>
    </td>
</tr>