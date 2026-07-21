<div class="pagination-container mb-3">
    <div class="rows-info">
        <span>
            Showing {{ $items->firstItem() ?? 0 }}
            to {{ $items->lastItem() ?? 0 }}
            of {{ $items->total() }} entries
        </span>
        <select
            class="form-select form-select-sm bg-transparent per-page-select"
            style="width: auto;"
            onchange="window.location.href = '{{ request()->url() }}?per_page=' + this.value;"
        >
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
        </select>
    </div>

    <ul class="pagination">
        <li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $items->url(1) }}&per_page={{ request('per_page', 10) }}">
                <i class="fas fa-angle-double-left"></i>
            </a>
        </li>
        <li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $items->previousPageUrl() }}&per_page={{ request('per_page', 10) }}">
                <i class="fas fa-angle-left"></i>
            </a>
        </li>
        <input type="number" min="1" max="{{ $items->lastPage() }}"
               value="{{ $items->currentPage() }}"
               class="btn-common-bg text-light border-0 text-center"
               style="width: 60px;"
               onchange="if(this.value >= 1 && this.value <= {{ $items->lastPage() }}) {
                    window.location='?page='+this.value+'&per_page={{ request('per_page', 10) }}'
               }">
        <li class="page-item {{ !$items->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $items->nextPageUrl() }}&per_page={{ request('per_page', 10) }}">
                <i class="fas fa-angle-right"></i>
            </a>
        </li>
        <li class="page-item {{ !$items->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $items->url($items->lastPage()) }}&per_page={{ request('per_page', 10) }}">
                <i class="fas fa-angle-double-right"></i>
            </a>
        </li>
    </ul>
</div>
