<?php

namespace App\Services;

use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\Organization;
use App\Models\LovType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class OrganizationAuthService
{
    public function handleCompanyIdentityStep(array $data, $organization_id)
    {
        return DB::transaction(function () use ($data, $organization_id) {

            $user = $this->createOrUpdateOrganizationAdmin($data);
            $organization = $user->organization()->updateOrCreate(
                ['id' => $organization_id],
                collect($data)->only([
                    'organization_type',
                    'name',
                    'website_url',
                    'secp_registration_number',
                    'pseb_registration_number',
                    'pasha_registration_number',
                    'ceo_name',
                    'ceo_contact',
                    'ceo_email',
                    'has_ksa_registered_company',
                    'saudi_entity_name',
                    'representative_name',
                    'representative_contact',
                    'representative_email'
                ])->toArray() + ['step' => '1']
            );

            if (isset($data['company_logo'])) {
                $this->storeCompanyLogo($user, $data['company_logo']);
            }

            return $organization;
        });
    }

    protected function storeCompanyLogo(User $user, $logo)
    {
        if ($logo instanceof \Illuminate\Http\UploadedFile) {
            $existingLogo = $user->images()->where('type', 'company_logo')->first();

            upload_image(
                $user,
                $logo,
                'company_logos',
                'company_logo',
                true,
                true,
                optional($existingLogo)->path
            );
        }
    }

    protected function createOrUpdateOrganizationAdmin(array $data)
    {
        $user = User::updateOrCreate(
            ['email' => $data['ceo_email']],
            [
                'name' => $data['ceo_name'],
                'phone' => $data['ceo_contact'],
                'is_active' => 0,
            ]
        );

        if (!$user->hasRole('organization_admin')) {
            $user->assignRole('organization_admin');
        }

        return $user;
    }

    public function handleCompanyInfoStep(array $data, int $organizationId)
    {
        $organization = Organization::updateOrCreate(
            ['id' => $organizationId],
            [
                'company_type' => $data['company_type'],
                'years_of_experience' => $data['years_of_experience'],
                'no_of_staff' => $data['no_of_staff'],
                'has_company_certificate' => $data['has_company_certificate'],
                'reference' => $data['reference'] ?? null,
                'no_of_projects' => $data['no_of_projects'],
                'reference_project' => $data['reference_project'] ?? null,
                'step' => '2',
            ]
        );

        $user = User::where('email', $organization->ceo_email)->first();
        if ($user && isset($data['industry_area']) && !empty($data['industry_area'])) {
            // Ensure industry_area is an integer
            $industryAreaId = is_array($data['industry_area']) ? (int) ($data['industry_area'][0] ?? 0) : (int) $data['industry_area'];
            
            if ($industryAreaId > 0) {
                DB::table('user_attributes')->updateOrInsert(
                    [
                        'user_id' => $user->id,
                        'attribute_type' => \App\Models\Lov::class,
                    ],
                    [
                        'attribute_id' => $industryAreaId,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        }

        $industryArea = $user->lovs()
            ->where('lovs.lov_type_id', LovType::idFromSlug('industry-type-ksa'))
            ->get();
        $organization->industry_area = $industryArea;

        return $organization;
    }

    public function handleProductsInfoStep(array $data, int $organizationId)
    {
        $organization = Organization::findOrFail($organizationId);
        
        // Get existing product IDs for this organization
        $existingProductIds = $organization->products->pluck('id')->toArray();
        
        // Track which product IDs are being updated
        $updatedProductIds = [];
        
        // Process each product from the form
        foreach ($data['name'] as $index => $productName) {
            $productId = isset($data['product_id'][$index]) && !empty($data['product_id'][$index]) 
                ? $data['product_id'][$index] 
                : null;
            
            $capabilities = $data['capabilities'][$index] ?? '';
            
            if ($productId) {
                // Update existing product by ID
                Product::where('id', $productId)
                    ->where('organization_id', $organizationId)
                    ->update([
                        'name' => $productName,
                        'capabilities' => $capabilities,
                    ]);
                $updatedProductIds[] = $productId;
            } else {
                // Create new product
                $newProduct = Product::create([
                    'organization_id' => $organizationId,
                    'name' => $productName,
                    'capabilities' => $capabilities,
                ]);
                $updatedProductIds[] = $newProduct->id;
            }
        }
        
        // Delete products that were removed from the form
        $productsToDelete = array_diff($existingProductIds, $updatedProductIds);
        if (!empty($productsToDelete)) {
            Product::where('organization_id', $organizationId)
                ->whereIn('id', $productsToDelete)
                ->delete();
        }
        
        Organization::where('id', $organizationId)->update(['step' => '3']);

        return $organization->load('products');
    }

    public function handleServiceInfoStep(array $data, int $organizationId)
    {
        $organization = Organization::findOrFail($organizationId);
        $organization->update([
            'ip'                  => $data['ip'] ?? '',
            'staff_certification' => $data['staff_certification'] ?? '',
            'step'                => 4,
        ]);
        $user = User::where('email', $organization->ceo_email)->firstOrFail();
        
        // Ensure service_domains is an array
        $serviceDomains = $data['service_domains'] ?? [];
        if (!is_array($serviceDomains)) {
            $serviceDomains = $serviceDomains ? [(int) $serviceDomains] : [];
        } else {
            $serviceDomains = array_map('intval', array_filter($serviceDomains));
        }
        
        // Get work domain type ID
        $workDomainTypeId = LovType::idFromSlug('service-domain');
        
        // First, remove existing service domains for this user
        DB::table('user_attributes')
            ->where('user_id', $user->id)
            ->where('attribute_type', \App\Models\Lov::class)
            ->where('lov_type_id', $workDomainTypeId)
            ->delete();
        
        // Then insert new service domains
        foreach ($serviceDomains as $domainId) {
            if (!empty($domainId) && $domainId > 0) {
                DB::table('user_attributes')->insert([
                    'user_id' => $user->id,
                    'attribute_type' => \App\Models\Lov::class,
                    'attribute_id' => (int) $domainId,
                    'lov_type_id' => $workDomainTypeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        // Ensure skills is an array
        $skills = $data['skills'] ?? [];
        if (!is_array($skills)) {
            $skills = $skills ? [(int) $skills] : [];
        } else {
            $skills = array_map('intval', array_filter($skills));
        }
        
        foreach ($skills as $skillId) {
            if (!empty($skillId) && $skillId > 0) {
                DB::table('user_attributes')->updateOrInsert(
                    [
                        'user_id' => $user->id,
                        'attribute_type' => \App\Models\Skill::class,
                        'attribute_id' => (int) $skillId,
                    ],
                    []
                );
            }
        }

        $serviceDomains = $user->lovs()
            ->where('lovs.lov_type_id', LovType::idFromSlug('service-domain'))
            ->get();
        $skills = $user->skills;
        $organization->serviceDomains = $serviceDomains;
        $organization->skills = $skills;

        return $organization;
    }

    public function getOrganizationData(int $organizationId)
    {
        $organization = Organization::with(['products', 'user.images'])->findOrFail($organizationId);
        $user = $organization->user;
        
        // Get industry area (lov_type_id = 3)
        $industryArea = $user->lovs()
            ->where('lovs.lov_type_id', LovType::idFromSlug('industry-type-ksa'))
            ->get();
        
        // Get service domains (lov_type_id = 4)
        $serviceDomains = $user->lovs()
            ->where('lovs.lov_type_id', LovType::idFromSlug('service-domain'))
            ->get();
        
        // Get skills
        $skills = $user->skills;
        
        return [
            'organization' => $organization,
            'industryArea' => $industryArea,
            'serviceDomains' => $serviceDomains,
            'skills' => $skills,
        ];
    }

    public function handlePasscodeStep(int $organizationId, string $passcode)
    {
        $organization = Organization::with(['products', 'user.images'])->findOrFail($organizationId);
        $user = $organization->user;
        $user->update([
            'passcode' => Hash::make($passcode),
        ]);
        $organization->update(['step' => 5]);
        $industryArea = $user->lovs()
            ->where('lovs.lov_type_id', LovType::idFromSlug('industry-type-ksa'))
            ->get();

        $serviceDomains = $user->lovs()
            ->where('lovs.lov_type_id', LovType::idFromSlug('service-domain'))
            ->get();
        $skills = $user->skills()
            ->where('is_active', true)
            ->where('type', 'business')
            ->get();

        return [
            'organization' => $organization,
            'industryArea' => $industryArea,
            'serviceDomains' => $serviceDomains,
            'skills' => $skills,
        ];
    }

    public function handleAccountVerification($request)
    {
        $organization = Organization::findOrFail($request->organization_id);
        $organization->update(['step' => 6, 'is_verified' => 1]);
        $user = User::where('email', $organization->ceo_email)->firstOrFail();
        $user->update(['is_active' => 1,'step' => 6,]);
        Auth::login($user, true);
    }

    public function handleCheckEmail(string $email)
    {
        $user = User::where('email', $email)->first();

        return $user;
    }

    public function handleSignIn(string $email, string $passcode)
    {
        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($passcode, $user->passcode)) {
            return null;
        }

        if ($user->hasRole('organization_admin')) {
            return [
                'user' => $user,
                'role' => 'organization_admin',
                'redirect' => route('company.dashboard')
            ];
        }

        if ($user->hasRole('customer')) {
            return [
                'user' => $user,
                'role' => 'customer',
                'redirect' => route('user.dashboard')
            ];
        }

        return null;
    }

    public function changePasscode(User $user, string $oldPasscode, string $newPasscode)
    {
        // Verify old passcode
        if (!Hash::check($oldPasscode, $user->passcode)) {
            throw new \Exception('The old passcode is incorrect.');
        }

        // Check if new passcode is different from old passcode
        if (Hash::check($newPasscode, $user->passcode)) {
            throw new \Exception('New passcode must be different from the old passcode.');
        }

        // Update passcode
        $user->update([
            'passcode' => Hash::make($newPasscode),
        ]);

        return true;
    }
}