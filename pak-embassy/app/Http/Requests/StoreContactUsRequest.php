<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest
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
            'full_name'          => 'nullable|string|max:255',
            'phone_number'       => 'nullable|string|max:20',
            'email'              => 'nullable|email|max:255',
            'reason_for_contact' => 'nullable|string|max:255',
            'message'            => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Please enter your message before submitting.',
            'email.email'      => 'Please provide a valid email address.',
        ];
    }
}
