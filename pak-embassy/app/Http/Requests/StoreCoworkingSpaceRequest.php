<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoworkingSpaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Update if you add policies/permissions
    }

    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:255',
            'phone'           => ['required', 'regex:/^(05\d{8}|9665\d{8}|\+9665\d{8})$/'],
            'email'           => 'required|email|unique:coworking_spaces,email',
            'starting_price'  => 'required|string|max:255',
            'month_rentals'   => 'required|integer|min:1',
            'people'          => 'required|integer|min:1',
            'space_type'      => 'required|string|in:Hot Desk,Dedicated Desk,Private Office,Shared Office',
            'location'        => 'required|string|max:255',
            'is_active'       => 'required|boolean',
            'space_overview'  => 'required|string',
            'space_description' => 'required|string',
            'space_amenities' => 'required|string',
            'image'         => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }
}