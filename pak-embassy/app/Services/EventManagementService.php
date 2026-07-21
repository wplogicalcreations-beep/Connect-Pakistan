<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Lov;
use Illuminate\Support\Str;
use App\Models\Status;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\EventInviteMail;
use App\Mail\EventMinutesOfMeetingMail;

class EventManagementService
{
    public function getAllEvents($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        return Event::with(['status'])
            ->applyFilter($request)
            ->with(['status'])
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    public function storeMinutes($minutes, $id)
    {
        $data['event_mom_detail'] = $minutes;
        $this->update($data, $id);
        
        // Send MoM email to all attendees
        $this->sendMoMEmailsToAttendees($id, $minutes);
    }
    
    private function sendMoMEmailsToAttendees($eventId, $momContent)
    {
        try {
            // Get event with attendees and their user emails
            $event = Event::with(['attendees.user'])
                ->where('id', $eventId)
                ->first();
            
            if (!$event) {
                return;
            }
            
            // Collect all attendee emails
            $attendeeEmails = [];
            foreach ($event->attendees as $attendee) {
                if ($attendee->user && $attendee->user->email) {
                    $attendeeEmails[] = $attendee->user->email;
                }
            }
            
            // Remove duplicates
            $attendeeEmails = array_unique($attendeeEmails);
            
            // Send email to each attendee
            if (!empty($attendeeEmails)) {
                foreach ($event->attendees as $attendee) {
                    if ($attendee->user && $attendee->user->email) {
                        Mail::to($attendee->user->email)
                            ->send(new EventMinutesOfMeetingMail($event, $momContent, $attendee->user));
                    }
                }
            }
        } catch (\Exception $e) {
            // Log error but don't throw exception to prevent breaking the MoM storage
            Log::error('Failed to send MoM emails to attendees: ' . $e->getMessage());
        }
    }

    public function store(array $data, $emails)
    {
        $data['start_date'] = date("Y-m-d", strtotime($data['start_date']));
        $data['end_date']   = date("Y-m-d", strtotime($data['end_date']));
        $data['start_time'] = date("H:i:s", strtotime($data['start_time']));
        $data['end_time']   = date("H:i:s", strtotime($data['end_time']));
        $data['event_id']   = $data['event_id'] ?? tap(Str::upper(Str::random(8)), function (&$id) {
            while (Event::where('event_id', $id)->exists()) {
                $id = Str::upper(Str::random(8));
            }
        });

        $event = Event::create([
            'event_id'         => $data['event_id'] ?? null,
            'name'             => $data['name'] ?? null,
            'status_id'        => $data['status_id'],
            'domain_id'        => $data['domain_id'],
            'description'      => $data['description'] ?? null,
            'start_date'       => $data['start_date'] ?? null,
            'end_date'         => $data['end_date'] ?? null,
            'start_time'       => $data['start_time'] ?? null,
            'end_time'         => $data['end_time'] ?? null,
            'event_type'       => $data['event_type'] ?? null,
            'event_mode'       => $data['event_mode'] ?? null,
            'location'         => $data['location'] ?? null,
            'city'             => $data['city'] ?? null,
            'meeting_link'     => $data['meeting_link'] ?? null,
            'event_mom'        => 1, // TODO: default set to 1, changes after discussion
            // 'event_mom'        => $data['event_mom'] ?? null,
            'event_activities' => $data['event_activities'] ?? null,
            'event_overview'   => $data['event_overview'] ?? null,
            'event_agenda'     => $data['event_agenda'] ?? null,
            'event_format'     => $data['event_format'] ?? null,
        ]);
        // Combine individuals, organizations, and embassies into attendees
        $attendees = [];
        if (isset($data['individual']) && is_array($data['individual'])) {
            foreach ($data['individual'] as $userId) {
                if (!empty($userId)) {
                    $attendees[] = ['user_id' => $userId];
                }
            }
        }
        if (isset($data['organization']) && is_array($data['organization'])) {
            foreach ($data['organization'] as $userId) {
                if (!empty($userId)) {
                    $attendees[] = ['user_id' => $userId];
                }
            }
        }
        if (isset($data['embassy']) && is_array($data['embassy'])) {
            foreach ($data['embassy'] as $userId) {
                if (!empty($userId)) {
                    $attendees[] = ['user_id' => $userId];
                }
            }
        }
        if (!empty($attendees)) {
            $this->storeAttendees($event, $attendees);
        }
        if (!empty($data['image'])) {
            $this->storeEventImage($event, $data['image']);
        }
        if ($event->event_type === 'private' && !empty($emails)) {
            $this->sendEventEmails($emails);
        }
    }
    
    private function storeAttendees(Event $event, array $attendees)
    {
        // Delete existing attendees
        $event->attendees()->delete();
        
        // Only create new attendees if array is not empty
        if (!empty($attendees)) {
            foreach ($attendees as $attendee) {
                if (!empty($attendee['user_id'])) {
                    $event->attendees()->create([
                        'user_id' => $attendee['user_id'],
                    ]);
                }
            }
        }
    }

    private function storeEventImage(Event $event, $image)
    {
        $existingEventImage = $event->images()->where('type', 'event_image')->first();

        upload_image(
            $event,
            $image,
            'event_images',
            'event_image',
            true,
            true,
            optional($existingEventImage)->path
        );
    }

    private function sendEventEmails(array $emails)
    {
        foreach ($emails as $email) {
            Mail::to($email)->send(new EventInviteMail());
        }
    }

    public function getEventData($eventId)
    {
        $event = Event::with(['attendees.user', 'status', 'images'])
            ->where('id', $eventId)
            ->first();

        return $event;
    }

    public function getDomains()
    {
        $domains = Lov::select('id', 'name')->where('lov_type_id', 4)->get();

        return $domains;
    }

    public function getStatus()
    {
        $status = Status::where('slug', 'active')->value('id');

        return $status;
    }

    public function getActiveAndClosedStatuses()
    {
        $statuses = Status::whereIn('slug', ['active', 'closed'])
            ->get(['id', 'name', 'slug']);

        return $statuses;
    }

    public function update(array $data, $id)
    {
        $event = Event::findOrFail($id);
        foreach (['start_date', 'end_date'] as $field) {
            if (!empty($data[$field]) && $data[$field] !== null) {
                $parsed = strtotime($data[$field]);
                if ($parsed !== false) {
                    $data[$field] = date("Y-m-d", $parsed);
                }
            }
        }
        foreach (['start_time', 'end_time'] as $field) {
            if (!empty($data[$field]) && $data[$field] !== null) {
                $parsed = strtotime($data[$field]);
                if ($parsed !== false) {
                    $data[$field] = date("H:i:s", $parsed);
                }
            }
        }
        $event->update([
            'name'             => $data['name'] ?? $event->name,
            'status_id'        => $data['status_id'] ?? $event->status_id,
            'domain_id'        => $data['domain_id'] ?? $event->domain_id,
            'description'      => $data['description'] ?? $event->description,
            'start_date'       => $data['start_date'] ?? $event->start_date,
            'end_date'         => $data['end_date'] ?? $event->end_date,
            'start_time'       => $data['start_time'] ?? $event->start_time,
            'end_time'         => $data['end_time'] ?? $event->end_time,
            'event_type'       => $data['event_type'] ?? $event->event_type,
            'event_mode'       => $data['event_mode'] ?? $event->event_mode,
            'location'         => $data['location'] ?? $event->location,
            'city'             => $data['city'] ?? $event->city,
            'meeting_link'     => ($data['event_mode'] ?? $event->event_mode) === 'virtual' ? ($data['meeting_link'] ?? $event->meeting_link) : null,
            'event_mom'        => $data['event_mom'] ?? $event->event_mom,
            'event_mom_detail' => $data['event_mom_detail'] ?? $event->event_mom_detail,
            'event_activities' => $data['event_activities'] ?? $event->event_activities,
            'event_overview'   => $data['event_overview'] ?? $event->event_overview,
            'event_agenda'     => $data['event_agenda'] ?? $event->event_agenda,
            'event_format'     => $data['event_format'] ?? $event->event_format,
        ]);

        // Combine individuals, organizations, and embassies into attendees
        $attendees = [];
        if (isset($data['individual']) && is_array($data['individual'])) {
            foreach ($data['individual'] as $userId) {
                if (!empty($userId)) {
                    $attendees[] = ['user_id' => $userId];
                }
            }
        }
        if (isset($data['organization']) && is_array($data['organization'])) {
            foreach ($data['organization'] as $userId) {
                if (!empty($userId)) {
                    $attendees[] = ['user_id' => $userId];
                }
            }
        }
        if (isset($data['embassy']) && is_array($data['embassy'])) {
            foreach ($data['embassy'] as $userId) {
                if (!empty($userId)) {
                    $attendees[] = ['user_id' => $userId];
                }
            }
        }
        if (!empty($attendees)) {
            $this->storeAttendees($event, $attendees);
        } elseif (empty($data['individual']) && empty($data['organization']) && empty($data['embassy'])) {
            // If all three are empty, clear attendees
            $event->attendees()->delete();
        }

        if (!empty($data['image'])) {
            $this->storeEventImage($event, $data['image']);
        }
    }

    public function deleteEvent($id)
    {
        $event = Event::with(['attendees', 'images'])->findOrFail($id);
        $event->attendees()->delete();
        $event->images()->delete();
        $event->delete();
    }
}