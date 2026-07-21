<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
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
            'job_post_id'     => 'required|exists:job_posts,id',
            'department_id'   => 'nullable|exists:departments,id',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'phone'           => 'required|string|regex:/^9665\d{8}$/',
            'street_address'  => 'required|string|max:255',
            'city'            => 'required|string|max:255',
            'state'           => 'required|string|max:255',
            'postal_code'     => 'required|string|max:50',
            'country'         => 'required|exists:countries,id',
            'linkedin_url'    => 'required|url',
            'portfolio_link'  => 'nullable|string',
            'resume'          => 'required|file|mimes:pdf,doc,docx|max:5120',
            'image'           => 'required|image|max:2048',
            'skills'          => 'nullable|string',
            
            // Education validation
            'education'                    => 'nullable|array',
            'education.*.degree_type'      => 'required_with:education|string|in:Bachelor,Master',
            'education.*.degree_name'      => 'required_with:education|string|max:255',
            'education.*.institution'      => 'required_with:education|string|max:255',
            'education.*.country_id'       => 'required_with:education|exists:countries,id',
            'education.*.start_date'       => 'required_with:education|date',
            'education.*.end_date'         => 'nullable|date|after:education.*.start_date',
            'education.*.currently_studying' => 'nullable|boolean',
            'education.*.description'      => 'nullable|string|max:1000',
            
            // Experience validation
            'experience'                   => 'nullable|array',
            'experience.*.job_title'       => 'required_with:experience|string|max:255',
            'experience.*.job_type'        => 'required_with:experience|string|in:Full Time,Part Time',
            'experience.*.company_name'    => 'required_with:experience|string|max:255',
            'experience.*.country_id'      => 'required_with:experience|exists:countries,id',
            'experience.*.start_date'      => 'required_with:experience|date',
            'experience.*.end_date'        => 'nullable|date|after:experience.*.start_date',
            'experience.*.currently_working' => 'nullable|boolean',
            'experience.*.description'     => 'required_with:experience|string|max:1000',
            'experience.*.your_location'   => 'nullable|string|max:255',
            'experience.*.company_location' => 'nullable|string|max:255',
        ];
    }
}
