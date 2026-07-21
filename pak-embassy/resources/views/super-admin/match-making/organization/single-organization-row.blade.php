<tr>
    <td class="sr-number">{{ $serialNumber }}</td>
    <td class="user-name">{{ $organization->name }}</td>
    <td class="user-ceo-name">{{ $organization->ceo_name }}</td>
    <td class="user-ceo-email">{{ $organization->ceo_email }}</td>
    <td class="user-ceo-phone">{{ $organization->ceo_contact }}</td>
    <td class="user-lovs">
        @if($organization->ceo && $organization->ceo->lovs_filtered->isNotEmpty())
            {{ $organization->ceo->lovs_filtered->take(3)->pluck('name')->join(', ') }}
        @else
            N/A
        @endif
    </td>
    <td class="user-skills">
        @if($organization->ceo && $organization->ceo->skills->isNotEmpty())
            {{ $organization->ceo->skills->take(3)->pluck('name')->join(', ') }}
        @else
            N/A
        @endif
    </td>
    <td>
        <button class="btn-common-bg py-1 p-2 rounded-2"><a href="{{ route('organization.view-match-making-organization', $organization->id) }}">View</a></button>
    </td>
</tr>