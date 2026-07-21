<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyInfoRequest extends FormRequest
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
            'organization_id' => ['required', 'integer', 'exists:organizations,id'],
            'company_type' => ['required', 'in:product,services,both'],
            'years_of_experience' => ['required', 'integer', 'min:0'],
            'no_of_staff' => ['required', 'integer', 'min:1'],
            'has_company_certificate' => ['required', 'boolean'],
            'industry_area' => ['required'],
            'reference' => ['nullable', 'string', 'max:255'],
            'no_of_projects' => ['required', 'integer', 'min:0'],
            'reference_project' => ['nullable', 'string', 'max:255'],
        ];
    }
}
