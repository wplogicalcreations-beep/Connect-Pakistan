<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventMinutesOfMeetingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $momContent;
    public $user;
    public $eventDetailUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Event $event, $momContent, User $user = null)
    {
        $this->event = $event;
        $this->momContent = $momContent;
        $this->user = $user;
        
        // Determine the correct event detail URL based on user role
        if ($user) {
            if ($user->hasRole('organization_admin')) {
                $this->eventDetailUrl = route('company.event.details', $event);
            } else {
                $this->eventDetailUrl = route('event.details', $event);
            }
        } else {
            // Fallback to user dashboard if user not provided
            $this->eventDetailUrl = route('event.details', $event);
        }
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Minutes of Meeting - ' . $this->event->name)
                    ->view('emails.event-mom');
    }
}

