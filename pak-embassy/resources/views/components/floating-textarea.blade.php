@props([
    'name' => '',
    'id' => null,
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'class' => '',
    'errorClass' => '',
    'oldValue' => null,
    'modelValue' => null,
    'useCkeditor' => false,
    'rows' => 4
])

@php
    $inputId = $id ?? $name;
    $inputValue = $oldValue ?? $modelValue ?? $value ?? '';
    $errorClass = $errors->has($name) ? 'is-invalid' : '';
    $finalClass = trim($class . ' ' . $errorClass);
    $textareaClass = $useCkeditor ? 'form-control ckeditor' : 'form-control';
@endphp

<div class="floating-custom-common mt-5">
    <div class="common-design">
        <textarea 
            class="{{ $textareaClass }} {{ $finalClass }}"
            id="{{ $inputId }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            rows="{{ $rows }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ $attributes }}
        >{{ $inputValue }}</textarea>
        <label for="{{ $inputId }}">{{ $label }}</label>
        @error($name)
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
