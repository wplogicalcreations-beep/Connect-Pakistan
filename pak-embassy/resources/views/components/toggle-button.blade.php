@props([
    'state' => false, 
    'id' => null,
    'url' => null // route to update status
])

@php
    // Generate unique ID if not provided, using a more unique identifier
    $id = $id ?? 'toggleSwitch_' . uniqid() . '_' . time();
@endphp

<div class="form-check form-switch">
    <input 
        class="form-check-input toggle-switch" 
        type="checkbox" 
        id="{{ $id }}" 
        data-url="{{ $url }}" 
        data-status="{{ $state == 1 ? 1 : 0 }}"
        {{ $state == 1 ? 'checked' : '' }}
    >
</div>
