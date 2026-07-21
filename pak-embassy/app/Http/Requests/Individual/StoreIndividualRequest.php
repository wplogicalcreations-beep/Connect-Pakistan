<?php

namespace App\Http\Requests\Individual;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreIndividualRequest extends FormRequest
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
            // Personal Information
            'name' => 'required|string|max:255',
            'passport_no' => 'required|string|max:50',
            'iqama_id' => [
                'required',
                'regex:/^[2]\d{9}$/'
            ],
            'phone' => [
                'required',
                'regex:/^9665\d{8}$/'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'linkedin_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            
            // Employment Information
            'level_id' => 'required|exists:lovs,id',
            'influence_ability_id' => 'required|exists:lovs,id',
            
            // Employment Area
            'industry_area_id' => 'required|exists:lovs,id',
            'work_domain_id' => 'required|exists:lovs,id',
            'skills' => 'required|array|min:1',
            'skills.*' => 'exists:skills,id',
            // 'additional_skills' => 'nullable|array',
            // 'additional_skills.*' => 'string|max:255',
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
            // Personal Information
            'name.required' => 'Full name is required.',
            'name.string' => 'Full name must be a valid string.',
            'name.max' => 'Full name cannot exceed 255 characters.',
            
            'passport_no.required' => 'Passport number is required.',
            'passport_no.string' => 'Passport number must be a valid string.',
            'passport_no.max' => 'Passport number cannot exceed 50 characters.',
            
            'iqama_id.required' => 'Iqama ID is required.',
            'iqama_id.regex' => 'Iqama ID must start with 2 and be 10 digits total.',
            
            'phone.required' => 'Mobile number is required.',
            'phone.regex' => 'Mobile number must start with 9665 and be 12 digits total (9665XXXXXXXX).',
            
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            
            'linkedin_url.url' => 'Please enter a valid LinkedIn profile URL.',
            
            'image.image' => 'Profile photo must be an image file.',
            'image.max' => 'Profile photo cannot exceed 2MB.',
            
            // Employment Information
            'level_id.required' => 'Level is required.',
            'level_id.exists' => 'Selected level does not exist.',
            
            'influence_ability_id.required' => 'Influence ability is required.',
            'influence_ability_id.exists' => 'Selected influence ability does not exist.',
            
            // Employment Area
            'industry_area_id.required' => 'Employer industry is required.',
            'industry_area_id.exists' => 'Selected employer industry does not exist.',
            
            'work_domain_id.required' => 'Work domain is required.',
            'work_domain_id.exists' => 'Selected work domain does not exist.',
            
            'skills.required' => 'At least one skill is required.',
            'skills.array' => 'Skills must be provided as an array.',
            'skills.min' => 'At least one skill must be selected.',
            'skills.*.exists' => 'One or more selected skills do not exist.',
            
            // 'additional_skills.array' => 'Additional skills must be provided as an array.',
            // 'additional_skills.*.string' => 'Each additional skill must be a valid string.',
            // 'additional_skills.*.max' => 'Additional skill cannot exceed 255 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}

