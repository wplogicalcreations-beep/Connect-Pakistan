<?php

namespace Database\Seeders;

use App\Helpers\IUserRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('roles')->truncate();
        $roles = array(
            array('name' => IUserRole::SUPER_ADMIN, 'guard_name' => 'web', 'created_at' => Carbon::now()),
            array('name' => IUserRole::CUSTOMER, 'guard_name' => 'web', 'created_at' => Carbon::now()),
            array('name' => IUserRole::ORGANIZATION_ADMIN, 'guard_name' => 'web', 'created_at' => Carbon::now()),
        );
        DB::table('roles')->insert($roles);
    }
}
