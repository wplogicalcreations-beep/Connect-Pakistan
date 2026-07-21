<?php

namespace Database\Seeders;

use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('skills')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $created_at = Carbon::now();


        // Base skills array
        $baseSkills = [
            ['name'=> 'Others', 'slug'=> Str::slug('Others'), 'is_active'=> true],
            ['name'=> 'Front end Development', 'slug'=> Str::slug('Front end Development'), 'is_active'=> true],
            ['name'=> 'Backend Development', 'slug'=> Str::slug('Backend Development'), 'is_active'=> true],
            ['name'=> 'Integration', 'slug'=> Str::slug('Integration'), 'is_active'=> true],
            ['name'=> 'Product dev(ERP, business specific etc.)', 'slug'=> Str::slug('Product dev(ERP, business specific etc.)'), 'is_active'=> true],
            ['name'=> 'BPM', 'slug'=> Str::slug('BPM'), 'is_active'=> true],
            ['name'=> 'Microservices', 'slug'=> Str::slug('Microservices'), 'is_active'=> true],
            ['name'=> 'Dev on platforms, including low code', 'slug'=> Str::slug('Dev on platforms, including low code'), 'is_active'=> true],
            ['name'=> 'Algorithmic development', 'slug'=> Str::slug('Algorithmic development'), 'is_active'=> true],
            ['name'=> 'Embedded systems', 'slug'=> Str::slug('Embedded systems'), 'is_active'=> true],
            ['name'=> 'Data warehouse, lake, Analytics, Science etc', 'slug'=> Str::slug('Data warehouse, lake, Analytics, Science etc'), 'is_active'=> true],
            ['name'=> 'Gen AI', 'slug'=> Str::slug('Gen AI'), 'is_active'=> true],
            ['name'=> 'Agentic AI', 'slug'=> Str::slug('Agentic AI'), 'is_active'=> true],
            ['name'=> 'Data Analysis', 'slug'=> Str::slug('Data Analysis'), 'is_active'=> true],
            ['name'=> 'Data Engineering', 'slug'=> Str::slug('Data Engineering'), 'is_active'=> true],
            ['name'=> 'Data Science', 'slug'=> Str::slug('Data Science'), 'is_active'=> true],
            ['name'=> 'ML Engineer', 'slug'=> Str::slug('ML Engineer'), 'is_active'=> true],
            ['name'=> 'AI / Deep Learning Engineer', 'slug'=> Str::slug('AI / Deep Learning Engineer'), 'is_active'=> true],
            ['name'=> 'AI Researcher', 'slug'=> Str::slug('AI Researcher'), 'is_active'=> true],
            ['name'=> 'Prompt Engineer', 'slug'=> Str::slug('Prompt Engineer'), 'is_active'=> true],
            ['name'=> 'ML Ops / AI Ops', 'slug'=> Str::slug('ML Ops / AI Ops'), 'is_active'=> true],
            ['name'=> 'Data Architect', 'slug'=> Str::slug('Data Architect'), 'is_active'=> true],
            ['name'=> 'Business Intelligence', 'slug'=> Str::slug('Business Intelligence'), 'is_active'=> true],
            ['name'=> 'Security Architecture', 'slug'=> Str::slug('Security Architecture'), 'is_active'=> true],
            ['name'=> 'ASOC', 'slug'=> Str::slug('ASOC'), 'is_active'=> true],
            ['name'=> 'Sec Ops', 'slug'=> Str::slug('Sec Ops'), 'is_active'=> true],
            ['name'=> 'Behavioral biometrics', 'slug'=> Str::slug('Behavioral biometrics'), 'is_active'=> true],
            ['name'=> 'Cyberfraud', 'slug'=> Str::slug('Cyberfraud'), 'is_active'=> true],
            ['name'=> 'Data Center', 'slug'=> Str::slug('Data Center'), 'is_active'=> true],
            ['name'=> 'Compute (Servers, DBA, Containers, VMs etc)', 'slug'=> Str::slug('Compute (Servers, DBA, Containers, VMs etc)'), 'is_active'=> true],
            ['name'=> 'Storage', 'slug'=> Str::slug('Storage'), 'is_active'=> true],
            ['name'=> 'Network', 'slug'=> Str::slug('Network'), 'is_active'=> true],
            ['name'=> 'Cloud', 'slug'=> Str::slug('Cloud'), 'is_active'=> true],
            ['name'=> 'CI/CD tools', 'slug'=> Str::slug('CI/CD tools'), 'is_active'=> true],
            ['name'=> 'Business Analysis', 'slug'=> Str::slug('Business Analysis'), 'is_active'=> true],
            ['name'=> 'Software Architecture', 'slug'=> Str::slug('Software Architecture'), 'is_active'=> true],
            ['name'=> 'Solution Architecture', 'slug'=> Str::slug('Solution Architecture'), 'is_active'=> true],
            ['name'=> 'Enterprise Architecture', 'slug'=> Str::slug('Enterprise Architecture'), 'is_active'=> true],
            ['name'=> 'Blockchain', 'slug'=> Str::slug('Blockchain'), 'is_active'=> true],
            ['name'=> 'Quantum Computing', 'slug'=> Str::slug('Quantum Computing'), 'is_active'=> true],
            ['name'=> 'Metaverse', 'slug'=> Str::slug('Metaverse'), 'is_active'=> true],
            ['name'=> 'Business PM', 'slug'=> Str::slug('Business PM'), 'is_active'=> true],
            ['name'=> 'Technical PM', 'slug'=> Str::slug('Technical PM'), 'is_active'=> true],
            ['name'=> 'Digital Transformation', 'slug'=> Str::slug('Digital Transformation'), 'is_active'=> true],
            ['name'=> 'Strategy', 'slug'=> Str::slug('Strategy'), 'is_active'=> true],
            ['name'=> 'Risk', 'slug'=> Str::slug('Risk'), 'is_active'=> true],
            ['name'=> 'Compliance, performance mgmt. value delivery', 'slug'=> Str::slug('Compliance, performance mgmt. value delivery'), 'is_active'=> true],
            ['name'=> 'EA governance', 'slug'=> Str::slug('EA governance'), 'is_active'=> true],
            ['name'=> 'Production Support', 'slug'=> Str::slug('Production Support'), 'is_active'=> true],
            ['name'=> 'Change Mgmt', 'slug'=> Str::slug('Change Mgmt'), 'is_active'=> true],
            ['name'=> 'Incident Mgmt', 'slug'=> Str::slug('Incident Mgmt'), 'is_active'=> true],
            ['name'=> 'Testing', 'slug'=> Str::slug('Testing'), 'is_active'=> true],
            ['name'=> 'Budgeting', 'slug'=> Str::slug('Budgeting'), 'is_active'=> true],
            ['name'=> 'Contract Mgmt', 'slug'=> Str::slug('Contract Mgmt'), 'is_active'=> true],
            ['name'=> 'Invoicing', 'slug'=> Str::slug('Invoicing'), 'is_active'=> true],
            ['name'=> 'Payments', 'slug'=> Str::slug('Payments'), 'is_active'=> true],
            ['name'=> 'Charge back Mechanism', 'slug'=> Str::slug('Charge back Mechanism'), 'is_active'=> true],
            ['name'=> 'IT Support & Help desk', 'slug'=> Str::slug('IT Support & Help desk'), 'is_active'=> true],
        ];

        // Duplicate each skill for both individual and business types
        $skills = [];
        foreach ($baseSkills as $skill) {
            // Add individual type
            $skills[] = array_merge($skill, ['type' => 'individual', 'created_at' => $created_at]);
            // Add business type
            $skills[] = array_merge($skill, ['type' => 'business', 'created_at' => $created_at]);
        }
 
        DB::table('skills')->insert($skills);
    }
}
