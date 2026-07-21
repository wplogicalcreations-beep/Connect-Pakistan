<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceInfoRequest extends FormRequest
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
            'organization_id' => 'required|exists:organizations,id',
            'service_domains' => 'required|array|min:1',
            'service_domains.*' => 'exists:lovs,id',
            'skills' => 'required|array|min:1',
            'skills.*' => 'exists:skills,id',
            'ip' => 'required|string|max:255',
            'staff_certification' => 'required|string|max:255',
        ];
    }
}
