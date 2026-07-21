<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequestForm extends FormRequest
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
            'coworking_space_id' => 'required|exists:coworking_spaces,id',
            'people_count'       => 'required',
            'space_type'         => 'required',
            'duration'           => 'required|in:0-3,3-6,6-12,12+',
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'phone_number'       => ['required', 'regex:/^9665\d{8}$/'],
            'email'              => 'required|email',
            'company_name'       => 'nullable|string|max:255',
            'estimated_start_date' => 'required|date|after:today',
            'terms'              => 'accepted',
        ];
    }

    public function messages(): array
    {
        return [
            'coworking_space_id.required' => 'Please select a coworking space.',
            'people_count.required' => 'Please select the number of people.',
            'space_type.required' => 'Please select a space type.',
            'duration.required' => 'Please select the duration.',
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'phone_number.required' => 'Phone number is required.',
            'phone_number.regex' => 'Phone number must start with 9665 and be 12 digits total (9665XXXXXXXX).',
            'email.required' => 'Email is required.',
            'email.email' => 'The email must be a valid email address.',
            'estimated_start_date.required' => 'Estimated start date is required.',
            'estimated_start_date.date' => 'Please enter a valid date.',
            'estimated_start_date.after' => 'Start date must be after today.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ];
    }
}
