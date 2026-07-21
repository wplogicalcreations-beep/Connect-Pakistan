@props([
    'name' => '',
    'id' => null,
    'type' => 'text',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'class' => '',
    'errorClass' => '',
    'oldValue' => null,
    'modelValue' => null
])

@php
    $inputId = $id ?? $name;
    $inputValue = $oldValue ?? $modelValue ?? $value ?? '';
    $errorClass = $errors->has($name) ? 'is-invalid' : '';
    $finalClass = trim($class . ' ' . $errorClass);
@endphp

<div class="form-floating floating-custom">
    <input 
        type="{{ $type }}"
        class="form-control {{ $finalClass }}"
        id="{{ $inputId }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ $inputValue }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $attributes }}
    >
    <label for="{{ $inputId }}">{{ $label }}</label>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
