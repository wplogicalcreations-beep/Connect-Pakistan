<?php

namespace App\Http\Requests\Organization;

use App\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrganizationRequest extends FormRequest
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
        $organizationId = $this->route('id');
        $orgType = $this->input('organization_type', 'PAK');
        $isKsa = $orgType === 'KSA';
        $organization = $organizationId ? Organization::with('user.images')->find($organizationId) : null;
        $hasExistingCompanyLogo = $organization
            && $organization->user
            && $organization->user->images->where('type', 'company_logo')->isNotEmpty();
        
        return [
            // Company Identity
            'organization_type' => ['required', Rule::in(['PAK', 'KSA'])],
            'name' => ['required', 'string', 'max:255'],
            'website_url' => [$isKsa ? 'required' : 'nullable', 'url', 'max:255'],
            'secp_registration_number' => [$isKsa ? 'nullable' : 'required', 'string', 'max:255'],
            'pseb_registration_number' => [$isKsa ? 'nullable' : 'required', 'string', 'max:255'],
            'pasha_registration_number' => [$isKsa ? 'nullable' : 'required', 'string', 'max:255'],
            'ceo_name' => [$isKsa ? 'required' : 'nullable', 'string', 'max:255'],
            'ceo_contact' => ['required', 'regex:/^9665\d{8}$/'],
            'ceo_email' => ['required', 'email', 'max:255', Rule::unique('organizations', 'ceo_email')->ignore($organizationId)->whereNull('deleted_at')],
            'has_ksa_registered_company' => [$isKsa ? 'nullable' : 'required', 'boolean'],
            'saudi_entity_name' => ['required', 'string', 'max:255'],
            'representative_name' => ['required', 'string', 'max:255'],
            'representative_contact' => ['required', 'regex:/^9665\d{8}$/'],
            'representative_email' => ['required', 'email', 'max:255'],
            'company_logo' => [($isKsa && !$hasExistingCompanyLogo) ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            
            // Company Info
            'company_type' => ['required', 'in:product,services'],
            'years_of_experience' => ['required', 'integer', 'min:0'],
            'no_of_staff' => ['required', 'integer', 'min:1'],
            'has_company_certificate' => ['required', 'boolean'],
            'industry_area' => ['required', 'integer', 'exists:lovs,id'],
            'reference' => ['nullable', 'string', 'max:255'],
            'no_of_projects' => ['required', 'integer', 'min:0'],
            'reference_project' => ['nullable', 'string', 'max:255'],
            
            // Products
            'product_name' => ['required', 'array'],
            'product_name.*' => ['required', 'string', 'max:255'],
            'product_capabilities' => ['required', 'array'],
            'product_capabilities.*' => ['required', 'string'],
            
            // Service Info
            'service_domains' => ['required', 'array', 'min:1'],
            'service_domains.*' => ['exists:lovs,id'],
            'skills' => ['required', 'array', 'min:1'],
            'skills.*' => ['exists:skills,id'],
            'ip' => ['required', 'string', 'max:255'],
            'staff_certification' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Company Identity
            'organization_type.required' => 'Organization type is required.',
            'organization_type.in' => 'Organization type must be either PAK or KSA.',

            'name.required' => 'Company name is required.',
            'name.string' => 'Company name must be a valid string.',
            'name.max' => 'Company name cannot exceed 255 characters.',
            
            'website_url.required' => 'Website URL is required for KSA organizations.',
            'website_url.url' => 'Please enter a valid website URL.',
            'website_url.max' => 'Website URL cannot exceed 255 characters.',
            
            'secp_registration_number.required' => 'SECP registration number is required.',
            'pseb_registration_number.required' => 'PSEB registration number is required.',
            'pasha_registration_number.required' => 'PASHA registration number is required.',
            
            'ceo_name.required' => 'CEO name is required for KSA organizations.',
            'ceo_name.string' => 'CEO name must be a valid string.',
            'ceo_name.max' => 'CEO name cannot exceed 255 characters.',
            
            'ceo_contact.required' => 'CEO contact number is required.',
            'ceo_contact.regex' => 'CEO contact must start with 9665 and be 12 digits total (9665XXXXXXXX).',
            
            'ceo_email.required' => 'CEO email is required.',
            'ceo_email.email' => 'Please enter a valid CEO email address.',
            'ceo_email.unique' => 'This CEO email is already registered.',
            'ceo_email.max' => 'CEO email cannot exceed 255 characters.',
            
            'has_ksa_registered_company.required' => 'Please specify if the company is registered in KSA.',
            'has_ksa_registered_company.boolean' => 'Invalid value for KSA registration status.',
            
            'saudi_entity_name.required' => 'Saudi entity name is required.',
            'saudi_entity_name.string' => 'Saudi entity name must be a valid string.',
            'saudi_entity_name.max' => 'Saudi entity name cannot exceed 255 characters.',
            
            'representative_name.required' => 'Representative name is required.',
            'representative_name.string' => 'Representative name must be a valid string.',
            'representative_name.max' => 'Representative name cannot exceed 255 characters.',
            
            'representative_contact.required' => 'Representative contact number is required.',
            'representative_contact.regex' => 'Representative contact must start with 9665 and be 12 digits total (9665XXXXXXXX).',
            
            'representative_email.required' => 'Representative email is required.',
            'representative_email.email' => 'Please enter a valid representative email address.',
            'representative_email.max' => 'Representative email cannot exceed 255 characters.',
            
            'company_logo.image' => 'Company logo must be an image file.',
            'company_logo.mimes' => 'Company logo must be a jpg, jpeg, png, or webp file.',
            'company_logo.max' => 'Company logo cannot exceed 2MB.',
            'company_logo.required' => 'Company logo is required for KSA organizations.',
            
            // Company Info
            'company_type.required' => 'Company type is required.',
            'company_type.in' => 'Company type must be either product or services.',
            
            'years_of_experience.required' => 'Years of experience is required.',
            'years_of_experience.integer' => 'Years of experience must be a number.',
            'years_of_experience.min' => 'Years of experience cannot be negative.',
            
            'no_of_staff.required' => 'Number of staff is required.',
            'no_of_staff.integer' => 'Number of staff must be a number.',
            'no_of_staff.min' => 'Number of staff must be at least 1.',
            
            'has_company_certificate.required' => 'Please specify if the company has a certificate.',
            'has_company_certificate.boolean' => 'Invalid value for company certificate status.',
            
            'industry_area.required' => 'Industry area is required.',
            'industry_area.integer' => 'Industry area must be a valid selection.',
            'industry_area.exists' => 'Selected industry area does not exist.',
            
            'no_of_projects.required' => 'Number of projects is required.',
            'no_of_projects.integer' => 'Number of projects must be a number.',
            'no_of_projects.min' => 'Number of projects cannot be negative.',
            
            // Products
            'product_name.required' => 'At least one product name is required.',
            'product_name.array' => 'Product names must be provided as an array.',
            'product_name.*.required' => 'Each product name is required.',
            'product_name.*.string' => 'Each product name must be a valid string.',
            'product_name.*.max' => 'Product name cannot exceed 255 characters.',
            
            'product_capabilities.required' => 'At least one product capability is required.',
            'product_capabilities.array' => 'Product capabilities must be provided as an array.',
            'product_capabilities.*.required' => 'Each product capability is required.',
            'product_capabilities.*.string' => 'Each product capability must be a valid string.',
            
            // Service Info
            'service_domains.required' => 'At least one service domain is required.',
            'service_domains.array' => 'Service domains must be provided as an array.',
            'service_domains.min' => 'At least one service domain must be selected.',
            'service_domains.*.exists' => 'One or more selected service domains do not exist.',
            
            'skills.required' => 'At least one skill is required.',
            'skills.array' => 'Skills must be provided as an array.',
            'skills.min' => 'At least one skill must be selected.',
            'skills.*.exists' => 'One or more selected skills do not exist.',
            
            'ip.required' => 'IP on Implement Methodologies is required.',
            'ip.string' => 'IP on Implement Methodologies must be a valid string.',
            'ip.max' => 'IP on Implement Methodologies cannot exceed 255 characters.',
            
            'staff_certification.required' => 'Staff certification information is required.',
            'staff_certification.string' => 'Staff certification must be a valid string.',
            'staff_certification.max' => 'Staff certification cannot exceed 255 characters.',
        ];
    }

}

