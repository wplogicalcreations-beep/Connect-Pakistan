@php
    $columns = $columns ?? [];
    $sortable = $sortable ?? [];
@endphp

<thead class="table-light">
    <tr>
        <th>Sr:</th>
        
        @foreach($columns as $index => $column)
            @php
                $label = ucfirst(str_replace('_', ' ', $column));
                $isSortable = isset($sortable[$index]) ? $sortable[$index] : true;
                $currentSortBy = request()->input('sort_by');
                $currentSortOrder = request()->input('sort_order', 'asc');
                $sortOrder = ($currentSortBy === $column && $currentSortOrder === 'asc') ? 'desc' : 'asc';
                
                // Preserve existing query parameters
                $queryParams = request()->query();
                $queryParams['sort_by'] = $column;
                $queryParams['sort_order'] = $sortOrder;
                $sortUrl = request()->url() . '?' . http_build_query($queryParams);
            @endphp
            <th>
                @if($isSortable)
                    <a href="{{ $sortUrl }}" class="text-decoration-none text-black">
                        {{ $label }}
                        <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                    </a>
                @else
                    {{ $label }}
                @endif
            </th>
        @endforeach
        
        <th>
            <div>
                Action
            </div>
        </th>
    </tr>
</thead>
