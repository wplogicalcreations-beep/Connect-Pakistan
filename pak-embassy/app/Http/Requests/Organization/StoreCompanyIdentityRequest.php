<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyIdentityRequest extends FormRequest
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
        $orgType = $this->input('organization_type', 'PAK');
        $isKsa = $orgType === 'KSA';

        return [
            'organization_type' => ['required', Rule::in(['PAK', 'KSA'])],

            'name' => ['required', 'string', 'max:255'],

            // Optional for PAK, mandatory for KSA
            'website_url' => [$isKsa ? 'required' : 'nullable', 'url', 'max:255'],
            'ceo_name' => [$isKsa ? 'required' : 'nullable', 'string', 'max:255'],
            'ceo_email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('organizations', 'ceo_email')
                    ->ignore($this->input('organization_id') ?? null)
                    ->whereNull('deleted_at'),
            ],

            // Required only for PAK organizations
            'secp_registration_number' => [$isKsa ? 'nullable' : 'required', 'string', 'max:255'],
            'pseb_registration_number' => [$isKsa ? 'nullable' : 'required', 'string', 'max:255'],
            'pasha_registration_number' => [$isKsa ? 'nullable' : 'required', 'string', 'max:255'],
            'ceo_contact' => ['required', 'regex:/^9665\d{8}$/'],
            'has_ksa_registered_company' => [$isKsa ? 'nullable' : 'required', 'boolean'],
            'saudi_entity_name' => ['required', 'string', 'max:255'],
            'representative_name' => ['required', 'string', 'max:255'],
            'representative_contact' => ['required', 'regex:/^9665\d{8}$/'],
            'representative_email' => ['required', 'email', 'max:255'],

            // Optional upload for PAK, mandatory for KSA
            'company_logo' => array_filter([
                $isKsa ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,svg',
                'max:2048',
            ]),
        ];
    }
}
