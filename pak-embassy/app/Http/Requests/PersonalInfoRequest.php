<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PersonalInfoRequest extends FormRequest
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
        $userId = $this->input('user_id');
        return [
            'name'     => 'required|string|max:255',
            'passport_no'   => 'required|string|max:50',
            'iqama_id' => [
                'required',
                'regex:/^[2]\d{9}$/'
            ],
            'phone' => [
                'required',
                'regex:/^9665\d{8}$/'
            ],
            'email'         => [
                'required',
                'email',
                $userId ? "unique:users,email,{$userId}" : 'unique:users,email'
            ],
            'linkedin_url'      => 'required|url',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
