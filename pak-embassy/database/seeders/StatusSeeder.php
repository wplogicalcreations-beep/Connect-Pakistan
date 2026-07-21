<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $now = Carbon::now();

        //Status

        $statuses = [
            ['name'=> 'Active',       'slug'=> Str::slug('Active'),       'created_at'=> $now],
            ['name'=> 'Inactive',     'slug'=> Str::slug('Inactive'),     'created_at'=> $now],
            ['name'=> 'Approved',     'slug'=> Str::slug('Approved'),     'created_at'=> $now],
            ['name'=> 'Pending',      'slug'=> Str::slug('Pending'),      'created_at'=> $now],
            ['name'=> 'Rejected',     'slug'=> Str::slug('Rejected'),     'created_at'=> $now],
            ['name'=> 'Cancelled',    'slug'=> Str::slug('Cancelled'),    'created_at'=> $now],
            ['name'=> 'Verified',     'slug'=> Str::slug('Verified'),     'created_at'=> $now],
            ['name'=> 'Draft',        'slug'=> Str::slug('Draft'),        'created_at'=> $now],
            ['name'=> 'Archived',     'slug'=> Str::slug('Archived'),     'created_at'=> $now],
            ['name'=> 'Completed',    'slug'=> Str::slug('Completed'),    'created_at'=> $now],
            ['name'=> 'Expired',      'slug'=> Str::slug('Expired'),      'created_at'=> $now],
            ['name'=> 'Suspended',    'slug'=> Str::slug('Suspended'),    'created_at'=> $now],
            ['name'=> 'In Review',    'slug'=> Str::slug('In Review'),    'created_at'=> $now],
            ['name'=> 'In Progress',  'slug'=> Str::slug('In Progress'),  'created_at'=> $now],
            ['name'=> 'On Hold',      'slug'=> Str::slug('On Hold'),      'created_at'=> $now],
            ['name' => 'Closed',      'slug' => Str::slug('closed'),      'created_at' => $now],
        ];

        // Insert into database
        DB::table('statuses')->insert($statuses);
    }
}
