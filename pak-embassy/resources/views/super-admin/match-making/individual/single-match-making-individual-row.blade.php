<tr>
    <td class="sr-number">{{ $serialNumber }}</td>
    <td class="user-name">{{ $user->name }}</td>
    <td class="user-email">{{ $user->email }}</td>
    <td class="user-phone">{{ $user->phone }}</td>
    <td class="user-lovs">
        @if($user->lovs->isNotEmpty())
            {{ $user->lovs->pluck('name')->join(', ') }}
        @else
            N/A
        @endif
    </td>
    <td class="user-skills">
        @if($user->skills->isNotEmpty())
            {{ $user->skills->pluck('name')->join(', ') }}
        @else
            N/A
        @endif
    </td>
    <td>
        <button class="btn-common-bg py-1 p-2 rounded-2"><a href="{{ route('individual.view-match-making-individual', $user->id) }}">View</a></button>
    </td>
</tr>