<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoworkingSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spaces = [
            [
                'name' => 'The Hive Downtown',
                'phone' => '+1-212-555-9012',
                'email' => 'contact@hivedowntown.com',
                'starting_price' => '250',
                'month_rentals' => 15,
                'people' => 120,
                'space_type' => 'Shared Office',
                'location' => 'Manhattan, New York, USA',
                'space_overview' => 'Premium coworking hub in downtown Manhattan for startups and freelancers.',
                'space_description' => 'The Hive Downtown offers modern interiors, high-speed internet, meeting rooms, and community networking events.',
                'space_amenities' => 'WiFi, Coffee Bar, Meeting Rooms, 24/7 Access, Printing Services',
            ],
            [
                'name' => 'TechNest Coworking',
                'phone' => '+44-20-5550-1122',
                'email' => 'info@technest.co.uk',
                'starting_price' => '180',
                'month_rentals' => 22,
                'people' => 200,
                'space_type' => 'Dedicated Desk',
                'location' => 'Shoreditch, London, UK',
                'space_overview' => 'A vibrant coworking space for digital nomads and tech startups.',
                'space_description' => 'TechNest provides ergonomic workstations, private offices, event spaces, and startup mentorship programs.',
                'space_amenities' => 'WiFi, Cafe, Lockers, Events, Mail Handling',
            ],
            [
                'name' => 'WorkHub Berlin',
                'phone' => '+49-30-555-6677',
                'email' => 'hello@workhubberlin.de',
                'starting_price' => '200',
                'month_rentals' => 18,
                'people' => 150,
                'space_type' => 'Private Office',
                'location' => 'Mitte, Berlin, Germany',
                'space_overview' => 'Trendy coworking hub located in the creative district of Berlin.',
                'space_description' => 'WorkHub Berlin combines industrial design with modern amenities and regular startup meetups.',
                'space_amenities' => 'WiFi, Kitchen, Printing, Bike Storage, Lounge Area',
            ],
            [
                'name' => 'Innovate Lahore',
                'phone' => '+92-42-322-4455',
                'email' => 'team@innovatelahore.pk',
                'starting_price' => '120',
                'month_rentals' => 10,
                'people' => 80,
                'space_type' => 'Hot Desk',
                'location' => 'Gulberg, Lahore, Pakistan',
                'space_overview' => 'Affordable coworking with community-driven atmosphere.',
                'space_description' => 'Innovate Lahore offers hot desks, meeting rooms, reliable internet, and startup events.',
                'space_amenities' => 'WiFi, Air Conditioning, Events, Tea/Coffee, Projector',
            ],
            [
                'name' => 'CoLab Sydney',
                'phone' => '+61-2-9876-5432',
                'email' => 'hello@colabsydney.com.au',
                'starting_price' => '220',
                'month_rentals' => 25,
                'people' => 300,
                'space_type' => 'Shared Office',
                'location' => 'CBD, Sydney, Australia',
                'space_overview' => 'Modern coworking space with harbour views and networking opportunities.',
                'space_description' => 'CoLab Sydney is designed for freelancers and entrepreneurs with premium amenities and flexible rentals.',
                'space_amenities' => 'WiFi, Cafe, Lockers, Events, Standing Desks',
            ],
            [
                'name' => 'StartHub Toronto',
                'phone' => '+1-416-555-7766',
                'email' => 'info@starthub.ca',
                'starting_price' => '210',
                'month_rentals' => 19,
                'people' => 180,
                'space_type' => 'Hot Desk',
                'location' => 'Downtown, Toronto, Canada',
                'space_overview' => 'Coworking space designed for creatives and entrepreneurs.',
                'space_description' => 'StartHub Toronto provides collaborative work areas, investor events, and wellness programs.',
                'space_amenities' => 'WiFi, Fitness Room, Coffee Bar, Library, Community Events',
            ],
            [
                'name' => 'Nexus Workspaces',
                'phone' => '+971-4-456-7788',
                'email' => 'contact@nexusdubai.ae',
                'starting_price' => '300',
                'month_rentals' => 28,
                'people' => 250,
                'space_type' => 'Private Office',
                'location' => 'Downtown, Dubai, UAE',
                'space_overview' => 'Premium coworking designed for international startups and enterprises.',
                'space_description' => 'Nexus Workspaces offer luxury office setups with stunning city views, high-end amenities, and networking events.',
                'space_amenities' => 'WiFi, Rooftop Cafe, Concierge, Valet Parking, 24/7 Access',
            ],
            [
                'name' => 'The Collective Mumbai',
                'phone' => '+91-22-555-9988',
                'email' => 'team@collectivemumbai.in',
                'starting_price' => '150',
                'month_rentals' => 20,
                'people' => 220,
                'space_type' => 'Shared Office',
                'location' => 'Bandra, Mumbai, India',
                'space_overview' => 'Creative coworking community in the heart of Mumbai.',
                'space_description' => 'The Collective Mumbai is tailored for freelancers and startups with vibrant interiors and cultural events.',
                'space_amenities' => 'WiFi, Lounge, Events, Free Coffee, Meeting Pods',
            ],
            [
                'name' => 'RemoteBase Bali',
                'phone' => '+62-361-777-8899',
                'email' => 'hello@remotebasebali.id',
                'starting_price' => '100',
                'month_rentals' => 12,
                'people' => 90,
                'space_type' => 'Hot Desk',
                'location' => 'Canggu, Bali, Indonesia',
                'space_overview' => 'Beachside coworking retreat for remote workers and digital nomads.',
                'space_description' => 'RemoteBase Bali combines work and leisure with fast internet, wellness classes, and open-air workspaces.',
                'space_amenities' => 'WiFi, Yoga Studio, Pool, Cafe, Lockers',
            ],
            [
                'name' => 'SkyWork Singapore',
                'phone' => '+65-6222-3344',
                'email' => 'info@skywork.sg',
                'starting_price' => '280',
                'month_rentals' => 30,
                'people' => 320,
                'space_type' => 'Private Office',
                'location' => 'Marina Bay, Singapore',
                'space_overview' => 'Exclusive coworking space with skyline views.',
                'space_description' => 'SkyWork Singapore offers private offices, premium meeting rooms, and networking with global entrepreneurs.',
                'space_amenities' => 'WiFi, Concierge, Cafe, Lounge, 24/7 Access',
            ],
            // add more to make 20 total...
        ];

        // Add more variations until we reach 20
        for ($i = count($spaces); $i < 20; $i++) {
            $spaces[] = [
                'name' => 'Cowork Hub ' . $i,
                'phone' => '+1-555-100' . $i,
                'email' => 'coworkhub' . $i . '@example.com',
                'starting_price' => rand(100, 300),
                'month_rentals' => rand(10, 30),
                'people' => rand(50, 300),
                'space_type' => ['Hot Desk', 'Dedicated Desk', 'Private Office', 'Shared Office'][rand(0, 3)],
                'location' => 'City Center, Demo City ' . $i,
                'space_overview' => 'A flexible coworking hub for freelancers and small businesses.',
                'space_description' => 'Cowork Hub ' . $i . ' provides a comfortable and collaborative work environment.',
                'space_amenities' => 'WiFi, Coffee, Meeting Rooms, Events',
            ];
        }

        DB::table('coworking_spaces')->insert($spaces);
    }
}
