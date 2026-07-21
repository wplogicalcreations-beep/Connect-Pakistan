<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ModuleSeeder::class,
            AssignPermissionSeeder::class,
            StatusSeeder::class,
            LovTypeSeeder::class,
            LovSeeder::class,
            SkillSeeder::class,
            StatusSeeder::class,
            RoleSeeder::class,
            SuperAdminSeeder::class,
            TemplateSeeder::class,
            CountrySeeder::class,
        ]);
    }
}
