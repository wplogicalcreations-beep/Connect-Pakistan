@props([
    'eventId',
    'action' => '#',
    'title' => 'Add Minutes of Meeting',
    'viewOnly' => false,
    'viewAs' => null,
    'event' => null, // pass the Event model itself
])

@php
    $modalId = 'minutesModal-' . $eventId . ($viewAs ? '-' . $viewAs : '');
    $freshEvent = $event?->fresh(); // reload the model from DB
    $minutes = $freshEvent?->event_mom_detail ?? '';
@endphp

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="minutesModalLabel-{{ $eventId }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="minutesModalLabel-{{ $eventId }}">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    @if($viewOnly)
                        <div id="minutes-content-{{ $eventId }}">Loading...</div>
                    @else
                        <textarea id="minutes-{{ $eventId }}" class="form-control ckeditor" rows="5" placeholder="Enter meeting details..." required>{{ old('minutes', $minutes) }}</textarea>
                    @endif
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                @unless($viewOnly)
                    <button type="button" class="btn btn-primary" 
                        onclick="submitMinutes('{{ $eventId }}', '{{ $action }}')">
                        Save Minutes
                    </button>
                @endunless
            </div>
        </div>
    </div>
</div>
