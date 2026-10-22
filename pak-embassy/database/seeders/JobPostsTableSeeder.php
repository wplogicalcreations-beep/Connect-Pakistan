<?php

namespace Database\Seeders;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();

        for ($i = 1; $i <= 20; $i++) {
            JobPost::create([
                'title'            => "Software Engineer $i",
                'organization_id'  => $user->id,
                'status_id'        => null,
                'description'      => 'We are looking for a skilled Software Engineer to join our growing team.',
                'responsibilities' => 'Develop web applications, maintain APIs, and collaborate with cross-functional teams.',
                'requirements'     => 'Proficiency in PHP/Laravel, MySQL, and React. 2+ years experience required.',
                'benefits'         => 'Health insurance, remote work options, and annual bonuses.',
                'min_salary'       => random_int(50000, 70000),
                'max_salary'       => random_int(80000, 120000),
                'min_experience'   => 1,
                'max_experience'   => 5,
                'vacancies'        => random_int(1, 5),
                'job_type'         => 'full_time',
                'work_mode'        => ['onsite', 'remote', 'hybrid'][random_int(0, 2)],
                'location'         => 'Sydney, Australia',
                'address'          => "123 Business Street, Sydney NSW $i",
                'posted_date'      => now(),
                'expiry_date'      => now()->addDays(random_int(15, 60)),
            ]);
        }
    }
}
