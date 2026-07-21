@php
    $startDateTime = $event->start_date && $event->start_time 
        ? \Carbon\Carbon::parse($event->start_date . ' ' . $event->start_time)->format('d-m-Y h:i A')
        : ($event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') : '-');
    
    $endDateTime = $event->end_date && $event->end_time 
        ? \Carbon\Carbon::parse($event->end_date . ' ' . $event->end_time)->format('d-m-Y h:i A')
        : ($event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d-m-Y') : '-');
@endphp
<tr id="event-{{ $event->id }}">
    <td class="event-name">{{ $event->name }}</td>
    <td class="event-type">{{ ucfirst($event->event_type ?? '-') }}</td>
    <td class="event-location">{{ $event->location ?? '-' }}</td>
    <td class="event-city">{{ $event->city ?? '-' }}</td>
    <td class="event-start-date">{{ $startDateTime }}</td>
    <td class="event-end-date">{{ $endDateTime }}</td>
    <td>
        @if($event->event_mom_detail)
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#momModal-{{ $event->id }}">
                View MoM
            </button>
            <!-- MoM Modal -->
            <div class="modal fade" id="momModal-{{ $event->id }}" tabindex="-1" aria-labelledby="momModalLabel-{{ $event->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="momModalLabel-{{ $event->id }}">{{ $event->name }} - Minutes of Meeting</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6 class="fw-bold mb-3">Here is the Minutes of Meeting</h6>
                            <div>
                                {!! $event->event_mom_detail !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <span class="text-muted">-</span>
        @endif
    </td>
</tr>

