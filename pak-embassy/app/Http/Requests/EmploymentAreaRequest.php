<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmploymentAreaRequest extends FormRequest
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
            'industry_area_id'          => 'required|exists:lovs,id',
            'work_domain_id' => 'required|exists:lovs,id',
            'skills'   => 'required|array|min:1',
            'skills.*' => 'exists:skills,id',
            'additional_skills' => 'nullable|array',
            'additional_skills.*' => 'string|max:255',
        ];
    }
}
