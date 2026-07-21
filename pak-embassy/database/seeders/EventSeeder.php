<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Event::create([
                'name'            => "Sample Event $i",
                'status_id'       => 1, // make sure you already have status with ID 1
                'domain_id'       => 1, // must exist in `lovs` table
                'description'     => "This is the description for Event $i",
                'start_date'      => now()->addDays($i),
                'end_date'        => now()->addDays($i + 1),
                'start_time'      => '10:00:00',
                'end_time'        => '17:00:00',
                'event_type'      => $i % 2 == 0 ? 'public' : 'private',
                'event_mode'      => $i % 2 == 0 ? 'onsite' : 'virtual',
                'location'        => "Location $i",
                'event_mom'       => (bool)random_int(0, 1),
                'event_activities' => (bool)random_int(0, 1),
                'event_overview'  => "Overview for Event $i",
                'event_agenda'    => "Agenda for Event $i",
                'event_format'    => "Format for Event $i",
            ]);
        }
    }
}
