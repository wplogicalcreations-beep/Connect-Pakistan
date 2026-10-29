<div class="col-md-12">
    <div class="table-responsive view-table">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">Sr:</th>
                    @foreach(['name', 'email', 'phone', 'lovs', 'skills'] as $index => $column)
                        @php
                            $sortable = [true, true, true, false, false];
                            $isSortable = $sortable[$index] ?? true;
                            $sortOrder = (request()->input('sort_by') === $column && request()->input('sort_order', 'asc') === 'asc') ? 'desc' : 'asc';
                            $sortUrl = request()->url() . '?' . http_build_query(array_merge(request()->query(), ['sort_by' => $column, 'sort_order' => $sortOrder]));
                        @endphp
                        <th scope="col">
                            @if($isSortable)
                                <a href="{{ $sortUrl }}" class="text-decoration-none text-black">
                                    {{ ucfirst(str_replace('_', ' ', $column)) }}
                                    <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                                </a>
                            @else
                                {{ ucfirst(str_replace('_', ' ', $column)) }}
                            @endif
                        </th>
                    @endforeach
                    <th scope="col">
                        <div>
                            Action
                        </div>
                    </th>
                </tr>
            </thead>            <tbody id="individualMatchMakingTable">
                @forelse($users as $index => $user)
                    <tr>
                        <td class="sr-number">{{ $index + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
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
                        <td class="user-skills text-truncate" title="{{ $user->skills->isNotEmpty() ? $user->skills->pluck('name')->join(', ') : 'N/A' }}"
                                    style="max-width: 200px;"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top">
                            @if($user->skills->isNotEmpty())
                            @foreach($user->skills as $skill)
                                <span
                                    class="d-inline-block">
                                    {{ Str::limit($skill->name, 40) }}
                                </span>
                            @endforeach
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <button class="btn-common-bg py-1 p-2 rounded-2"><a href="{{ route('individual.view-match-making-individual', $user->id) }}">View</a></button>
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
<x-pagination :items="$users"/>

@include('super-admin.match-making.individual.modal')
