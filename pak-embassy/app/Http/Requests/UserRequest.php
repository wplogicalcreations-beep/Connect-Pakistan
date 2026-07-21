<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // For update requests, get user ID from route parameter
        $userId = $this->isMethod('post') ? null : $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required', 
                'string', 
                'max:20', 
                'regex:/^9665\d{8}$/',
                $this->isMethod('post') ? 'unique:users,phone' : 'unique:users,phone,' . $userId
            ],
            'email' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'email', 
                'max:255',
                $this->isMethod('post') ? 'unique:users,email' : 'unique:users,email,' . $userId
            ],
            'password' => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'min:6', 'confirmed'],
            'nid' => ['required', 'digits:10', 'regex:/^[1-3][0-9]{9}$/'],
            'department_id' => ['required', 'exists:departments,id'],
            'role' => ['required', 'exists:roles,name'],
            'is_active' => ['boolean'],
        ];
    }
}
