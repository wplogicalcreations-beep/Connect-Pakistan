<div class="col-md-12">
    <div class="table-responsive view-table">
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th class="sortable" data-sort="event-id">Event ID<img class="sort-arrow" src="images/sort-arrow.svg"
                                 alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-name">Event Name <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-type">Event Type <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-city">City <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-location">Location<img class="sort-arrow" src="images/sort-arrow.svg"
                                 alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="meeting-link">Meeting Link<img class="sort-arrow" src="images/sort-arrow.svg"
                                 alt="Sort Arrow">
                </th>
                {{-- <th class="sortable" data-sort="event-mom">MoM <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>

                <th class="sortable" data-sort="event-activites">Activities <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">
                </th> --}}

                <th class="sortable" data-sort="event-start-date">Start Date <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-start-time">Start Time <img class="sort-arrow" src="images/sort-arrow.svg"
                                    alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-end-date">End Date <img class="sort-arrow" src="images/sort-arrow.svg"
                                  alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-end-time">End Time <img class="sort-arrow" src="images/sort-arrow.svg"
                                  alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-mom">M.O.M <img class="sort-arrow" src="images/sort-arrow.svg"
                                  alt="Sort Arrow">
                </th>
                <th class="sortable" data-sort="event-status">Status <img class="sort-arrow" src="images/sort-arrow.svg" alt="Sort Arrow">
                </th>
                <th>
                    <div>
                        Action
                    </div>
                </th>
            </tr>
            </thead>
            <tbody id="eventsTable">
                @forelse($events as $index => $event)
                @php
                    $eventEnd = \Carbon\Carbon::parse($event->end_date . ' ' . $event->end_time);
                @endphp
                    <tr id="event-{{ $event->id }}">
                        <td class="event-id">{{ $event->event_id }}</td>
                        <td class="event-name">{{ $event->name }}</td>
                        <td class="event-type">{{ $event->event_type }}</td>
                        <td class="event-city">{{ $event->city ?? '-' }}</td>
                        <td class="event-location">{{ $event->location ?? '-' }}</td>
                        <td class="meeting-link">
                            @if($event->meeting_link)
                                <a href="{{ $event->meeting_link }}" target="_blank" rel="noopener noreferrer">
                                    {{ $event->meeting_link }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        {{-- <td class="event-mom">{{ $event->event_mom == 1 ? 'Active' : 'Disable' }}</td>
                        <td class="event-activities">{{ $event->event_activities == 1 ? 'Active' : 'Disable' }}</td> --}}
                        <td class="event-start-date">{{ $event->start_date }}</td>
                        <td class="event-start-time">{{ $event->start_time }}</td>
                        <td class="event-end-date">{{ $event->end_date }}</td>
                        <td class="event-end-time">{{ $event->end_time }}</td>
                        <td class="event-mom">
                            @if($event->end_date && $eventEnd->isPast())
                                <a href="#" class="badge p-2 bg-success-2" data-bs-toggle="modal" data-bs-target="#minutesModal-{{ $event->id }}-view" onclick="loadMinutes({{ $event->id }}, true)">
                                    View
                                </a>

                                <!-- onclick refresh data and rander the modal -->
                                <x-minutes-modal 
                                    :event-id="$event->id" 
                                    :view-only="true" 
                                    viewAs="view"
                                    title="View Minutes"
                                    :event="$event->fresh()"
                                />
                            @else
                                -
                            @endif
                        </td>
                        <td class="event-status">
                            <span class="badge p-2 
                                {{ strtolower($event->status->name) === 'active' ? 'bg-success-2' : '' }} 
                                {{ strtolower($event->status->name) === 'closed' ? 'bg-danger' : '' }}">
                                {{ $event->status->name }}
                            </span>
                        </td>
                        <td>
                            @if($event->end_date && $eventEnd->isPast())
                            <x-minutes-modal
                                :event-id="$event->id" 
                                :view-only="false" 
                                :action="route('events.save-minutes', $event->id)" 
                                viewAs="edit"
                                title="Edit Minutes"
                                :event="$event->fresh()"
                            />
                            @endif

                            <div class="dropdown">
                                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                    Select
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" 
                                            href="{{ route('events.view', ['event' => $event->id]) }}">
                                            <img src="images/Bookings.svg" class="me-2" alt="View-icon">View 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" 
                                            href="{{ route('events.action-items', ['event' => $event->id]) }}">
                                            <img src="images/add-btn.svg" class="me-2" alt="Action-icon" style="width: 16px; height: 16px;">Add Action Item
                                        </a>
                                    </li>
                                    @if($event->end_date && $eventEnd->isPast())
                                        <li>
                                            <a
                                                href="#" 
                                                class="dropdown-item" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#minutesModal-{{ $event->id }}-edit"
                                                onclick="loadMinutes({{ $event->id }}, false)"
                                                >
                                                <img src="images/add-btn.svg" class="me-2" alt="Add-icon" style="width: 16px; height: 16px;">Add MOM
                                            </a>
                                        </li>

                                    @else
                                        <li>
                                            <a class="dropdown-item" 
                                                href="{{ route('events.edit-event', ['id' => $event->id, 'type' => $event->event_type]) }}">
                                                <img src="images/edit.svg" class="me-2" alt="Edit-icon">Edit 
                                            </a>
                                        </li>
                                    @endif

                                    <li>
                                        <a class="dropdown-item" href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModalToggle"
                                            data-id="{{ $event->id }}">
                                            <img src="{{ asset('images/delete-icon.svg') }}" class="me-2" alt="delete-icon">Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="no-record-row">
                        <td colspan="16" class="text-center">No record found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<x-pagination :items="$events"/>

@include('super-admin.events.modal')
