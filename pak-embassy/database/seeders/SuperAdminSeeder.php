<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'super_admin']);
        $user = User::updateOrCreate(
            ['email' => 'superadmin@embassy.com'],
            [
                'name'         => 'Super Admin',
                'email'        => 'superadmin@embassy.com',
                'password'     => Hash::make('root@123'),
                'is_active'    => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]
        );

        if (!$user->hasRole('super_admin')) {
            $user->assignRole($role);
        }
    }
}