<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventManagementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event_id'         => ['nullable', 'string', 'max:255'],
            'name'             => ['required', 'string', 'max:255'],
            'status_id'        => ['required', 'exists:statuses,id'],
            'domain_id'        => ['required', 'exists:lovs,id'],
            'description'      => ['nullable', 'string'],
            'start_date'       => ['required', 'date'],
            'end_date'         => ['required', 'date', 'after_or_equal:start_date'],
            'start_time'       => ['required', 'date_format:g:i A'],
            'end_time'         => ['required', 'date_format:g:i A'],
            'event_type'       => ['required', 'in:public,private'],
            'event_mode'       => ['required', 'in:onsite,virtual'],
            'location'         => ['nullable', 'string', 'max:255'],
            'city'             => ['nullable', 'string', 'max:255'],
            'meeting_link'     => ['required_if:event_mode,virtual', 'nullable', 'url', 'max:255'],
            'event_mom'        => ['nullable', 'boolean'],
            'event_mom_detail' => ['nullable', 'string', 'max:65535'],
            'event_activities' => ['nullable', 'boolean'],
            'event_overview'   => ['required', 'string'],
            'event_agenda'     => ['required', 'string'],
            'event_format'     => ['required', 'string'],
            'individual'            => ['nullable', 'array'],
            'individual.*'           => ['required', 'exists:users,id'],
            'organization'          => ['nullable', 'array'],
            'organization.*'        => ['required', 'exists:users,id'],
            'embassy'              => ['nullable', 'array'],
            'embassy.*'            => ['required', 'exists:users,id'],
            'attendees'              => ['nullable', 'array'],
            'attendees.*.user_id'    => ['nullable', 'exists:users,id'],
            'image'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    protected function prepareForValidation()
    {
        // Filter out empty attendee entries before validation
        if ($this->has('attendees') && is_array($this->input('attendees'))) {
            $attendees = array_filter($this->input('attendees', []), function($attendee) {
                return !empty($attendee['user_id']);
            });
            // If all attendees were filtered out, set to empty array
            if (empty($attendees)) {
                $this->merge(['attendees' => []]);
            } else {
                $this->merge(['attendees' => array_values($attendees)]);
            }
        } else {
            // If attendees is not provided or not an array, set to empty array
            $this->merge(['attendees' => []]);
        }
    }
}