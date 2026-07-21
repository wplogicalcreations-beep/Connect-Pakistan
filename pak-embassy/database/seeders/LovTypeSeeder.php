<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\LovType;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LovTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('lov_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $created_at = Carbon::now();
        $lovTypes = [
            // Individual category
            ['name'=> 'Level', 'slug'=> Str::slug('Level'), 'category'=> 'individual', 'created_at'=> $created_at],
            ['name'=> 'Influence Ability', 'slug'=> Str::slug('Influence Ability'), 'category'=> 'individual', 'created_at'=> $created_at],
            ['name'=> 'Industry Area', 'slug'=> Str::slug('Industry Area'), 'category'=> 'individual', 'created_at'=> $created_at],
            ['name'=> 'Work Domain', 'slug'=> Str::slug('Work Domain'), 'category'=> 'individual', 'created_at'=> $created_at],
            
            // Business category
            ['name'=> 'Company Type', 'slug'=> Str::slug('Company Type'), 'category'=> 'business', 'created_at'=> $created_at],
            ['name'=> 'Industry Type KSA', 'slug'=> Str::slug('Industry Type KSA'), 'category'=> 'business', 'created_at'=> $created_at],
            ['name'=> 'Product Name', 'slug'=> Str::slug('Product Name'), 'category'=> 'business', 'created_at'=> $created_at],
            ['name'=> 'Service Domain', 'slug'=> Str::slug('Service Domain'), 'category'=> 'business', 'created_at'=> $created_at],
            ['name'=> 'Service Skills', 'slug'=> Str::slug('Service Skills'), 'category'=> 'business', 'created_at'=> $created_at],
            
            // Embassy category
            ['name'=> 'Event Domain', 'slug'=> Str::slug('Event Domain'), 'category'=> 'embassy', 'created_at'=> $created_at],
            ['name'=> 'Event Mode', 'slug'=> Str::slug('Event Mode'), 'category'=> 'embassy', 'created_at'=> $created_at],
            ['name'=> 'Lead Type', 'slug'=> Str::slug('Lead Type'), 'category'=> 'embassy', 'created_at'=> $created_at],
            ['name'=> 'Customers', 'slug'=> Str::slug('Customers'), 'category'=> 'embassy', 'created_at'=> $created_at],
        ];
        DB::table('lov_types')->insert($lovTypes);
    }

}
