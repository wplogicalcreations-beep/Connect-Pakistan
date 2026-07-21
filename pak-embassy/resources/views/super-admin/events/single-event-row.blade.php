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
                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#minutesModal-{{ $event->id }}-view" onclick="loadMinutes({{ $event->id }}, true)">
                    View
                </button>

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
                    @if($event->end_date && $eventEnd->isPast())
                        <li>
                            <a
                                href="#" 
                                class="dropdown-item" 
                                data-bs-toggle="modal" 
                                data-bs-target="#minutesModal-{{ $event->id }}-edit"
                                onclick="loadMinutes({{ $event->id }}, false)"
                                >
                                <img src="images/edit.svg" class="me-2" alt="Edit-icon">Add MOM
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