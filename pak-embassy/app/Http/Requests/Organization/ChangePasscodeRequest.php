<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasscodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_passcode' => 'required|string|digits:6',
            'new_passcode' => 'required|string|digits:6|confirmed',
            'new_passcode_confirmation' => 'required|string|digits:6',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'old_passcode.required' => 'Please enter your old passcode.',
            'old_passcode.digits' => 'Old passcode must be exactly 6 digits.',
            'new_passcode.required' => 'Please enter a new passcode.',
            'new_passcode.digits' => 'New passcode must be exactly 6 digits.',
            'new_passcode.confirmed' => 'New passcode and confirmation do not match.',
            'new_passcode_confirmation.required' => 'Please confirm your new passcode.',
            'new_passcode_confirmation.digits' => 'Passcode confirmation must be exactly 6 digits.',
        ];
    }
}

