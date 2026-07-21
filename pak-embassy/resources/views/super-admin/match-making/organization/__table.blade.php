<div class="col-md-12">
    <div class="table-responsive view-table">
        <table class="table table-striped table-hover">
            <x-table-head
                :items="$organizations"
                :columns="['name', 'ceo_name', 'ceo_email', 'ceo_contact', 'work_domain', 'skilled']"
                :sortable="[true, true, true, true, false, false]"
            />
            <tbody id="organizationMatchMakingTable">
                @forelse($organizations as $index => $organization)
                    <tr>
                        <td class="sr-number">{{ $index + 1 + ($organizations->currentPage() - 1) * $organizations->perPage() }}</td>
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
                        <td class="user-skills text-truncate" title="{{ $organization->ceo && $organization->ceo->skills->isNotEmpty() ? $organization->ceo->skills->pluck('name')->join(', ') : 'N/A' }}"
                                    style="max-width: 200px;"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top">
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
                @empty
                    <tr>
                        <td colspan="16" class="text-center">No record found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<x-pagination :items="$organizations"/>

@include('super-admin.match-making.individual.modal')
