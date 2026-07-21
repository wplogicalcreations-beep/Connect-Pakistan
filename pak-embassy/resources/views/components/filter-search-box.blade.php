@php
    $columns = $columns ?? [];
    $tableId = $tableId ?? '';
    $paginationContainer = $paginationContainer ?? '';
@endphp

@if(isset($columns) && count($columns) > 0)
<div class="input-group mb-3 drop-buttons">
    <button class="btn btn-outline-secondary dropdown-toggle filter-button" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('images/filter-icon.svg') }}" alt="Filter Icon">
        <span id="filter-name" data-filter="{{$columns[0] ?? 'all'}}">{{ ucfirst(str_replace('_', ' ', $columns[0] ?? 'all')) }}</span>
    </button>
    <ul class="dropdown-menu" id="filterDropdown">
        @foreach($columns as $column)
            <li><a class="dropdown-item" data-filter="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</a></li>
        @endforeach

    </ul>
    <input type="text" id="searchInput" class="form-control search-input" placeholder="Search"
            aria-label="Text input with dropdown button">
</div>
@endif
@once
<script>
    (function() {
        const tableId = '{{ $tableId }}';
        const paginationContainer = '{{ $paginationContainer }}';
        
        // Wait for jQuery to be available
        function initFilterSearch() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initFilterSearch, 100);
                return;
            }
            
            $(document).ready(function () {
                /**
                 * Handle filter dropdown click
                 */
                $(document).on('click', '#filterDropdown li a', function (e) {
                    e.preventDefault();

                    const filterText  = $(this).text();
                    const filterValue = $(this).attr('data-filter');

                    // Update filter label and attribute
                    $('#filter-name')
                        .text(filterText)
                        .attr('data-filter', filterValue);
                });

                /**
                 * Search input handler
                 */
                let typingTimer;
                const typingDelay = 400;

                $('#searchInput').on('keyup', function () {
                    clearTimeout(typingTimer);

                    const search = $(this).val();

                    typingTimer = setTimeout(() => {

                        // Always use clean URL (avoid duplicated params)
                        const url = window.location.origin + window.location.pathname;

                        // Read filter dynamically (NO .data())
                        const filter = $('#filter-name').attr('data-filter') || 'name';

                        $.ajax({
                            url: url,
                            type: 'GET',
                            data: {
                                [filter !== 'all' ? filter : 'name']: search
                            },
                            success: function (response) {
                                if (response.success) {
                                    // Update table rows if tableId is provided
                                    if (tableId) {
                                        $('#' + tableId).html(response.html);
                                    }

                                    // Update pagination if paginationContainer is provided
                                    if (paginationContainer) {
                                        $('.' + paginationContainer).replaceWith(response.pagination);
                                    }
                                }
                            },
                            error: function (xhr) {
                                console.error(xhr.responseText);
                            }
                        });

                    }, typingDelay);
                });
            });
        }
        
        // Start initialization
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initFilterSearch);
        } else {
            initFilterSearch();
        }
    })();
</script>
@endonce