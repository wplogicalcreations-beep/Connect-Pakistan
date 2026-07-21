<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKnowledgeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->input('id'); // route id

        return [
            'id' => ['required', 'integer', 'exists:knowledge_bases,id'],
            'page_name' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('knowledge_bases', 'page_name')->ignore($id),
            ],
            'heading' => 'nullable|string|max:255',
            'status_id' => 'nullable|integer',
            'sections' => 'required|array|min:1|max:10',
            'sections.*.id' => 'nullable|integer|exists:knowledge_base_sections,id',
            'sections.*.name' => 'nullable|string|max:255',
            'sections.*.content' => 'nullable|string',
            'sections.*.image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $sections = $this->input('sections', []);
            
            // Filter out completely empty sections
            $validSections = array_filter($sections, function($section) {
                return !empty($section['name']) && !empty($section['content']);
            });
            
            // Check if we have at least one valid section
            if (count($validSections) < 1) {
                $validator->errors()->add('sections', 'At least one section with name and content is required.');
            }
            
            // Remove validation errors for empty sections
            foreach ($sections as $index => $section) {
                if (empty($section['name']) && empty($section['content'])) {
                    $validator->errors()->forget("sections.{$index}.name");
                    $validator->errors()->forget("sections.{$index}.content");
                }
            }
        });
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'sections.required' => 'At least one section is required.',
            'sections.min' => 'At least one section is required.',
            'sections.max' => 'Maximum 10 sections allowed.',
            'sections.*.name.required_with' => 'Section name is required.',
            'sections.*.name.max' => 'Section name cannot exceed 255 characters.',
            'sections.*.content.required_with' => 'Section content is required.',
            'sections.*.image.image' => 'Section image must be a valid image file.',
            'sections.*.image.mimes' => 'Section image must be a file of type: jpeg, jpg, png, gif.',
            'sections.*.image.max' => 'Section image may not be greater than 2MB.',
        ];
    }
}
