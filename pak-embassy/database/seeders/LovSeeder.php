<?php

namespace Database\Seeders;

use App\Models\LovType;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LovSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('lovs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $now = Carbon::now();
        
        $levelTypeId = LovType::idFromSlug(LovType::LEVEL);
        $influenceTypeId = LovType::idFromSlug(LovType::INFLUENCE_ABILITY);
        $industryTypeId = LovType::idFromSlug(LovType::INDUSTRY_AREA);
        $industryAreaKsaTypeId = LovType::idFromSlug(LovType::INDUSTRY_TYPE_KSA);
        $domainTypeId = LovType::idFromSlug(LovType::WORK_DOMAIN);
        $serviceDomainTypeId = LovType::idFromSlug(LovType::SERVICE_DOMAIN);

        // Level values
        $level = [
            ['lov_type_id' => $levelTypeId, 'name' => 'Entry Level',  'slug' => Str::slug('Entry Level'),  'created_at' => $now],
            ['lov_type_id' => $levelTypeId, 'name' => 'Mid Level',    'slug' => Str::slug('Mid Level'),    'created_at' => $now],
            ['lov_type_id' => $levelTypeId, 'name' => 'Executive Level',    'slug' => Str::slug('Executive Level'),    'created_at' => $now],
            ['lov_type_id' => $levelTypeId, 'name' => 'Senior Level', 'slug' => Str::slug('Senior Level'), 'created_at' => $now],
            ['lov_type_id' => $levelTypeId, 'name' => 'C-level',      'slug' => Str::slug('C-level'),      'created_at' => $now],
            ['lov_type_id' => $levelTypeId, 'name' => 'Board Level',  'slug' => Str::slug('Board Level'),  'created_at' => $now],
        ];

        // Influence Ability values
       $influence_abilities = [
            ['lov_type_id' => $influenceTypeId, 'name' => 'Individual Contributor', 'slug' => Str::slug('Individual Contributor'), 'created_at' => $now],
            ['lov_type_id' => $influenceTypeId, 'name' => 'Subject Matter Expert', 'slug' => Str::slug('Subject Matter Expert'), 'created_at' => $now],
            ['lov_type_id' => $influenceTypeId, 'name' => 'Change Agent', 'slug' => Str::slug('Change Agent'), 'created_at' => $now],
            ['lov_type_id' => $influenceTypeId, 'name' => 'Hiring Authority', 'slug' => Str::slug('Hiring Authority'), 'created_at' => $now],
            ['lov_type_id' => $influenceTypeId, 'name' => 'Hiring Influence', 'slug' => Str::slug('Hiring Influence'), 'created_at' => $now],
            ['lov_type_id' => $influenceTypeId, 'name' => 'Acquisition/Contract Award Authority', 'slug' => Str::slug('Acquisition/Contract Award Authority'), 'created_at' => $now],
            ['lov_type_id' => $influenceTypeId, 'name' => 'Acquisition/Contract Award Influence', 'slug' => Str::slug('Acquisition/Contract Award Influence'), 'created_at' => $now],
        ];

        // Industry Area values
        $industryArea = [
            ['lov_type_id' => $industryTypeId, 'name' => 'Big Tech', 'slug' => Str::slug('Big Tech'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Technology Services(Sys Integrators, testing etc)', 'slug' => Str::slug('Technology Services(Sys Integrators, testing etc)'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Technology Products', 'slug' => Str::slug('Technology Products'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Management Consulting', 'slug' => Str::slug('Management Consulting'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Consulting Services', 'slug' => Str::slug('Consulting Services'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'R&D/ Innovation', 'slug' => Str::slug('R&D/ Innovation'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Financial Institutions', 'slug' => Str::slug('Financial Institutions'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Telecoms', 'slug' => Str::slug('Telecoms'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'FMCG', 'slug' => Str::slug('FMCG'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Media', 'slug' => Str::slug('Media'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Multinationals', 'slug' => Str::slug('Multinationals'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Small & Medium Enterprise', 'slug' => Str::slug('Small & Medium Enterprise'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'eCommerce', 'slug' => Str::slug('eCommerce'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Education Industry', 'slug' => Str::slug('Education Industry'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Healthcare', 'slug' => Str::slug('Healthcare'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Government', 'slug' => Str::slug('Government'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Accounting', 'slug' => Str::slug('Accounting'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Legal Services', 'slug' => Str::slug('Legal Services'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Media & Entertainment', 'slug' => Str::slug('Media & Entertainment'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Hospitality & Logistics', 'slug' => Str::slug('Hospitality & Logistics'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Real Estate & Property Management', 'slug' => Str::slug('Real Estate & Property Management'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Retail Goods', 'slug' => Str::slug('Retail Goods'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Oil & Gas / Energy', 'slug' => Str::slug('Oil & Gas / Energy'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Construction', 'slug' => Str::slug('Construction'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Manufacturing', 'slug' => Str::slug('Manufacturing'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Utilities & Power Generation', 'slug' => Str::slug('Utilities & Power Generation'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Aerospace & Defence', 'slug' => Str::slug('Aerospace & Defence'), 'created_at' => $now],
            ['lov_type_id' => $industryTypeId, 'name' => 'Mining', 'slug' => Str::slug('Mining'), 'created_at' => $now],
        ];

        // Industry Type KSA values
        $industryAreaKsa = [
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Big Tech', 'slug' => Str::slug('Big Tech'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Technology Services(Sys Integrators, testing etc)', 'slug' => Str::slug('Technology Services(Sys Integrators, testing etc)'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Technology Products', 'slug' => Str::slug('Technology Products'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Management Consulting', 'slug' => Str::slug('Management Consulting'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Consulting Services', 'slug' => Str::slug('Consulting Services'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'R&D/ Innovation', 'slug' => Str::slug('R&D/ Innovation'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Financial Institutions', 'slug' => Str::slug('Financial Institutions'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Telecoms', 'slug' => Str::slug('Telecoms'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'FMCG', 'slug' => Str::slug('FMCG'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Media', 'slug' => Str::slug('Media'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Multinationals', 'slug' => Str::slug('Multinationals'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Small & Medium Enterprise', 'slug' => Str::slug('Small & Medium Enterprise'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'eCommerce', 'slug' => Str::slug('eCommerce'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Education Industry', 'slug' => Str::slug('Education Industry'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Healthcare', 'slug' => Str::slug('Healthcare'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Government', 'slug' => Str::slug('Government'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Accounting', 'slug' => Str::slug('Accounting'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Legal Services', 'slug' => Str::slug('Legal Services'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Media & Entertainment', 'slug' => Str::slug('Media & Entertainment'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Hospitality & Logistics', 'slug' => Str::slug('Hospitality & Logistics'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Real Estate & Property Management', 'slug' => Str::slug('Real Estate & Property Management'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Retail Goods', 'slug' => Str::slug('Retail Goods'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Oil & Gas / Energy', 'slug' => Str::slug('Oil & Gas / Energy'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Construction', 'slug' => Str::slug('Construction'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Manufacturing', 'slug' => Str::slug('Manufacturing'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Utilities & Power Generation', 'slug' => Str::slug('Utilities & Power Generation'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Aerospace & Defence', 'slug' => Str::slug('Aerospace & Defence'), 'created_at' => $now],
            ['lov_type_id' => $industryAreaKsaTypeId, 'name' => 'Mining', 'slug' => Str::slug('Mining'), 'created_at' => $now],
        ];

        // Work Domain values
        $workDomain = [
            ['lov_type_id' => $domainTypeId, 'name' => 'Other', 'slug' => Str::slug('Other'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'IT', 'slug' => Str::slug('IT'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Operations', 'slug' => Str::slug('Operations'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Shared Services', 'slug' => Str::slug('Shared Services'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Real Estate', 'slug' => Str::slug('Real Estate'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Procurement', 'slug' => Str::slug('Procurement'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Risk', 'slug' => Str::slug('Risk'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Compliance', 'slug' => Str::slug('Compliance'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Cybersecurity', 'slug' => Str::slug('Cybersecurity'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Credit', 'slug' => Str::slug('Credit'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Collections', 'slug' => Str::slug('Collections'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Finance', 'slug' => Str::slug('Finance'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Digital', 'slug' => Str::slug('Digital'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Strategy', 'slug' => Str::slug('Strategy'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Customer Experience', 'slug' => Str::slug('Customer Experience'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Innovation', 'slug' => Str::slug('Innovation'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Marketing', 'slug' => Str::slug('Marketing'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Legal', 'slug' => Str::slug('Legal'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'HR', 'slug' => Str::slug('HR'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Government & Corporate affairs', 'slug' => Str::slug('Government & Corporate affairs'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Internal Audit', 'slug' => Str::slug('Internal Audit'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Customer Value Management', 'slug' => Str::slug('Customer Value Management'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Products', 'slug' => Str::slug('Products'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Business Management', 'slug' => Str::slug('Business Management'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Customer Engagement', 'slug' => Str::slug('Customer Engagement'), 'created_at' => $now],
            ['lov_type_id' => $domainTypeId, 'name' => 'Sales', 'slug' => Str::slug('Sales'), 'created_at' => $now],
        ];

        // Service Domain values
        $serviceDomain = [
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Other', 'slug' => Str::slug('Other'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'IT', 'slug' => Str::slug('IT'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Operations', 'slug' => Str::slug('Operations'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Shared Services', 'slug' => Str::slug('Shared Services'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Real Estate', 'slug' => Str::slug('Real Estate'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Procurement', 'slug' => Str::slug('Procurement'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Risk', 'slug' => Str::slug('Risk'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Compliance', 'slug' => Str::slug('Compliance'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Cybersecurity', 'slug' => Str::slug('Cybersecurity'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Credit', 'slug' => Str::slug('Credit'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Collections', 'slug' => Str::slug('Collections'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Finance', 'slug' => Str::slug('Finance'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Digital', 'slug' => Str::slug('Digital'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Strategy', 'slug' => Str::slug('Strategy'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Customer Experience', 'slug' => Str::slug('Customer Experience'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Innovation', 'slug' => Str::slug('Innovation'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Marketing', 'slug' => Str::slug('Marketing'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Legal', 'slug' => Str::slug('Legal'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'HR', 'slug' => Str::slug('HR'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Government & Corporate affairs', 'slug' => Str::slug('Government & Corporate affairs'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Internal Audit', 'slug' => Str::slug('Internal Audit'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Customer Value Management', 'slug' => Str::slug('Customer Value Management'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Products', 'slug' => Str::slug('Products'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Business Management', 'slug' => Str::slug('Business Management'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Customer Engagement', 'slug' => Str::slug('Customer Engagement'), 'created_at' => $now],
            ['lov_type_id' => $serviceDomainTypeId, 'name' => 'Sales', 'slug' => Str::slug('Sales'), 'created_at' => $now],
        ];



        // Merge all arrays
        $allLovValues = array_merge(
            $level,
            $influence_abilities,
            $industryArea,
            $industryAreaKsa,
            $workDomain,
            $serviceDomain
        );

        // Insert into database
        DB::table('lovs')->insert($allLovValues);
    }
}
