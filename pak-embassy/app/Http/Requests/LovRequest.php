<?php

namespace App\Http\Requests;

use App\Models\LovType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LovRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $lovTypeId = $this->route('type')
                ? LovType::idFromSlug($this->route('type'))
                : $this->route('lov')->lov_type_id;

        $this->merge([
            'lov_type_id' => $lovTypeId,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Using route model binding: {skill}
        $lovId = $this->route('lov')->id??null;
        return [
            'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('lovs')
                ->where(function ($query) {
                    return $query->where('lov_type_id', $this->input('lov_type_id'));
                })
                ->ignore($lovId),
            ],
            'lov_type_id'   => ['exists:lov_types,id'],
//            'is_active'     => ['required', 'boolean'],
        ];
    }
}
