<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
        // Using route model binding: {skill}
        $skillId = $this->route('skill')->id??null;
         return [
            'name' => 'required|string|unique:skills,name,' . $skillId. ',id,deleted_at,NULL',
            'type' => 'required|in:individual,business',
//            'is_active' => ['required', 'boolean'],
        ];

    }
}
