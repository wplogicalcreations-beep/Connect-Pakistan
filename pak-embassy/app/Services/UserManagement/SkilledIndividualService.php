<?php

namespace App\Services\UserManagement;

use App\Helpers\GeneralHelper;
use App\Models\Lov;
use App\Models\LovType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SkilledIndividualService
{
    /**
     * Get skilled individuals query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getSkilledIndividuals($request)
    {
        return User::whereHas('roles', function ($query) {
                $query->where('name', 'customer');
            })
            ->where('step', 5)
            ->with([
                'work_domain',
                'skills:id,name',
                'level'
            ])
            ->applyFilter($request)
            ->select(['id', 'name', 'is_active', 'created_at']);
    }

    public function sendInvitation(string $email)
    {
        Mail::raw("You are invited to join as a Skilled Individual User. Click the link to register.", function ($message) use ($email) {
            $message->to($email)
                ->subject("Invitation to Join Platform");
        });

        return true;
    }

    public function getSkilledIndividual($user_id)
    {
        return User::with(['work_domain', 'skills:id,name', 'individualProfile', 'images', 'experiences', 'educations', 'certificates'])
            ->where('id', $user_id)
            ->first();
    }

    public function updateStatus($data)
    {
        $user = User::findOrFail($data['user_id']);
        $user->is_active = $data['action'] === 'approve' ? 1 : 0;
        $user->save();
        return $user;
    }

    public function deleteSkilledIndividual($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    /**
     * Store a new individual user (combines all registration steps)
     *
     * @param \Illuminate\Http\Request $request
     * @return User
     */
    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            // Create base user
            $userData = $request->only(['name', 'phone', 'email']);
            // Set a default passcode (user can change it later)
            $userData['passcode'] = Hash::make('123456'); // Default passcode
            $userData['is_active'] = true;
            $userData['step'] = 5; // Registration completed
            
            $user = User::create($userData);
            
            // Assign customer role
            $user->assignRole('customer');
            
            $path = 'users/' . $user->id;
            
            // Handle profile image
            if ($request->hasFile('image')) {
                $image = upload_image($user, $request->file('image'), $path);
                $user->images()->save($image);
            }
            
            // Create individual profile
            $profileData = $request->only(['passport_no', 'iqama_id', 'linkedin_url']);
            
            // Handle additional skills
            if ($request->has('additional_skills') && is_array($request->additional_skills) && !empty($request->additional_skills)) {
                $profileData['additional_skills'] = json_encode($request->additional_skills);
            }
            
            $user->individualProfile()->create(array_merge(
                $profileData,
                ['user_id' => $user->id]
            ));
            
            // Attach Level
            $levelTypeId = LovType::idFromSlug('level');
            if ($request->level_id) {
                $user->lovs()->attach($request->level_id, ['lov_type_id' => $levelTypeId]);
            }
            
            // Attach Influence Ability
            $influenceAbilityTypeId = LovType::idFromSlug('influence-ability');
            if ($request->influence_ability_id) {
                $user->lovs()->attach($request->influence_ability_id, ['lov_type_id' => $influenceAbilityTypeId]);
            }
            
            // Attach Industry Area
            $industryAreaTypeId = LovType::idFromSlug('industry-area');
            if ($request->industry_area_id) {
                $user->lovs()->attach($request->industry_area_id, ['lov_type_id' => $industryAreaTypeId]);
            }
            
            // Attach Work Domain
            $workDomainTypeId = LovType::idFromSlug('work-domain');
            if ($request->work_domain_id) {
                $user->lovs()->attach($request->work_domain_id, ['lov_type_id' => $workDomainTypeId]);
            }
            
            // Sync Skills
            if ($request->has('skills') && is_array($request->skills)) {
                $user->skills()->sync($request->skills);
            }
            
            return $user;
        });
    }

    /**
     * Update an existing individual user
     *
     * @param \Illuminate\Http\Request $request
     * @param int $userId
     * @return User
     */
    public function update($request, $userId)
    {
        return DB::transaction(function () use ($request, $userId) {
            $user = User::findOrFail($userId);
            
            // Update base user
            $userData = $request->only(['name', 'phone', 'email']);
            $user->update($userData);
            
            $path = 'users/' . $user->id;
            
            // Handle profile image
            if ($request->hasFile('image')) {
                // Delete old images if needed
                $user->images()->delete();
                $image = upload_image($user, $request->file('image'), $path);
                $user->images()->save($image);
            }
            
            // Update individual profile
            $profileData = $request->only(['passport_no', 'iqama_id', 'linkedin_url']);
            
            // Handle additional skills - check if it's a JSON string or array
            if ($request->has('additional_skills')) {
                if (is_string($request->additional_skills)) {
                    // If it's a JSON string, decode it
                    $decoded = json_decode($request->additional_skills, true);
                    $profileData['additional_skills'] = !empty($decoded) ? json_encode($decoded) : null;
                } elseif (is_array($request->additional_skills) && !empty($request->additional_skills)) {
                    $profileData['additional_skills'] = json_encode($request->additional_skills);
                } else {
                    $profileData['additional_skills'] = null;
                }
            } else {
                $profileData['additional_skills'] = null;
            }
            
            $user->individualProfile()->updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );
            
            // Update Level
            $levelTypeId = LovType::idFromSlug('level');
            DB::table('user_attributes')
                ->where('user_id', $user->id)
                ->where('attribute_type', Lov::class)
                ->where('lov_type_id', $levelTypeId)
                ->delete();
            if ($request->level_id) {
                $user->lovs()->attach($request->level_id, ['lov_type_id' => $levelTypeId]);
            }
            
            // Update Influence Ability
            $influenceAbilityTypeId = LovType::idFromSlug('influence-ability');
            DB::table('user_attributes')
                ->where('user_id', $user->id)
                ->where('attribute_type', Lov::class)
                ->where('lov_type_id', $influenceAbilityTypeId)
                ->delete();
            if ($request->influence_ability_id) {
                $user->lovs()->attach($request->influence_ability_id, ['lov_type_id' => $influenceAbilityTypeId]);
            }
            
            // Update Industry Area
            $industryAreaTypeId = LovType::idFromSlug('industry-area');
            DB::table('user_attributes')
                ->where('user_id', $user->id)
                ->where('attribute_type', Lov::class)
                ->where('lov_type_id', $industryAreaTypeId)
                ->delete();
            if ($request->industry_area_id) {
                $user->lovs()->attach($request->industry_area_id, ['lov_type_id' => $industryAreaTypeId]);
            }
            
            // Update Work Domain
            $workDomainTypeId = LovType::idFromSlug('work-domain');
            DB::table('user_attributes')
                ->where('user_id', $user->id)
                ->where('attribute_type', Lov::class)
                ->where('lov_type_id', $workDomainTypeId)
                ->delete();
            if ($request->work_domain_id) {
                $user->lovs()->attach($request->work_domain_id, ['lov_type_id' => $workDomainTypeId]);
            }
            
            // Sync Skills
            if ($request->has('skills') && is_array($request->skills)) {
                $user->skills()->sync($request->skills);
            }
            
            return $user;
        });
    }
}