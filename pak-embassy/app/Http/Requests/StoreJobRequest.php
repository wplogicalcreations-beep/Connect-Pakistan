<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobRequest extends FormRequest
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
            'title'          => 'required|string|max:255',
            'domain_id'      => 'required|exists:lovs,id',
            'job_type'       => 'required|in:full_time,part_time,contract,internship',
            'work_mode'      => 'required|in:onsite,remote,hybrid',
            'location'       => 'nullable|string|max:255',
            'address'        => 'nullable|string|max:255',
            'vacancies'      => 'required|integer|min:1',

            'description'    => 'required|string',
            'responsibilities' => 'required|string',
            'requirements'   => 'required|string',
            'benefits'       => 'required|string',

            'min_experience' => 'required|integer|min:0|max:50',
            'max_experience' => [
                'required',
                'integer',
                'min:0',
                'max:50',
                'gte:min_experience',
            ],

            'min_salary' => 'required|numeric|min:1|max:10000000',
            'max_salary' => [
                'required',
                'numeric',
                'min:1',
                'max:10000000',
                'gte:min_salary',
            ],
            'posted_date'    => 'nullable|date',
            'expiry_date' => 'required|date|after_or_equal:posted_date|after:today',
            'currency'       => 'required|string|max:10',
            'embed_map'      => 'nullable|string|max:1000',
        ];
    }
}
