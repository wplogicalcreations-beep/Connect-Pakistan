<div class="col-12 col-md-10 ps-4">
    <x-filter-search-box
        :columns="['event_id', 'name', 'event_type', 'city', 'location', 'meeting_link', 'start_date', 'start_time', 'end_date', 'end_time']"
        tableId="eventsTable"
        paginationContainer="pagination-container"
    />
</div>
<div class="col-12 col-md-2 my-3 mt-md-0 btn-resp">

    <button type="button" class="btn btn-common-bg add-new-event-btn">
        <div class="dropdown">
            <a class="btn btn-primary btn-sm dropdown-toggle bg-transparent border-0" href="#"
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                + Add New Event
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('events.store-event', ['type' => 'public']) }}"
                       data-bs-target="#staticBackdrop" style="color: inherit;"><span class="fw-bold">+</span> Public Event</a></li>

                <li>
                    <a class="dropdown-item" href="{{ route('events.store-event', ['type' => 'private']) }}"
                       role="button" style="color: inherit;"><span class="fw-bold">+</span> Private Event</a>
                </li>
            </ul>
        </div>

    </button>

</div>
