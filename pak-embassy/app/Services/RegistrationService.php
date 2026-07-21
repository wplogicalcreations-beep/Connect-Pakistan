<?php

namespace App\Services;

use App\Helpers\GeneralHelper;
use App\Models\LovType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{

    public function storePersonalInfo($request)
    {
        return DB::transaction(function () use ($request) {
            // Base User attributes
            $userData = $request->only(['name', 'phone', 'email']); // only user table fields
            $userId = $request->input('user_id');

            $user = User::updateOrCreate(
                ['id' => $userId],
                $userData
            );

            $path = 'users/' . $user->id;

            // Image
            if ($request->hasFile('image')) {
                $image = upload_image($user, $request->file('image'), $path);
                $user->images()->save($image);
            }

            // Individual profile attributes
            $profileData = $request->only(['passport_no', 'iqama_id', 'linkedin_url']);
            $user->individualProfile()->updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );

            $user->assignRole('customer');
            return $user;
        });
    }


    public function storeEmploymentInfo($request, $user)
    {
        $levelTypeId = LovType::idFromSlug('level');
        $influenceAbilityTypeId = LovType::idFromSlug('influence-ability');

        // First, detach existing level and influence ability LOVs
        $user->lovs()->wherePivot('lov_type_id', $levelTypeId)->detach();
        $user->lovs()->wherePivot('lov_type_id', $influenceAbilityTypeId)->detach();

        // Then attach new ones
        if ($request->level_id) {
            $user->lovs()->attach($request->level_id, ['lov_type_id' => $levelTypeId]);
        }

        if ($request->influence_ability_id) {
            $user->lovs()->attach($request->influence_ability_id, ['lov_type_id' => $influenceAbilityTypeId]);
        }

        $user->update(['step' => 2]);
        return $user;
    }

    public function storeEmploymentArea($request, $user)
    {
        $industryAreaTypeId = LovType::idFromSlug('industry-area');
        $workDomainTypeId   = LovType::idFromSlug('work-domain');

        // First, detach existing industry area and work domain LOVs
        $user->lovs()->wherePivot('lov_type_id', $industryAreaTypeId)->detach();
        $user->lovs()->wherePivot('lov_type_id', $workDomainTypeId)->detach();

        // Then attach new industry area(s)
        if (!empty($request->industry_area_id)) {
            foreach ((array)$request->industry_area_id as $industryAreaId) {
                $user->lovs()->attach($industryAreaId, ['lov_type_id' => $industryAreaTypeId]);
            }
        }

        // Then attach new work domain(s)
        if (!empty($request->work_domain_id)) {
            foreach ((array)$request->work_domain_id as $workDomainId) {
                $user->lovs()->attach($workDomainId, ['lov_type_id' => $workDomainTypeId]);
            }
        }

        // Sync Skills (remove unchecked, add checked)
        $user->skills()->sync($request->skills ?? []);

        // Save additional skills in JSON
        $user->individualProfile->update([
            'additional_skills' => $request->additional_skills ? json_encode($request->additional_skills) : null,
        ]);

        // Update registration step
        $user->update(['step' => 3]);

        return $user;
    }

    public function finalizeRegistration($request, $user)
    {
        $user->passcode  = Hash::make($request->passcode);
        $user->is_active = true;
        $user->step = 5;
        $user->save();

        // Log the user in
        Auth::login($user);
        return $user;
    }

    public function details($user)
    {
        $level = $user->level;
        $individualProfile = $user->individualProfile;
        $influence_ability = $user->influence_ability;
        $work_domain = $user->work_domain;
        $industry_area = $user->industry_area;
        $skills = $user->skills;
        $image = $user->images;

        return [
            'user'=>$user,
            'level'=>$level,
            'influence_ability'=>$influence_ability,
            'industry_area' =>$industry_area,
            'work_domain' =>$work_domain,
            'skills' =>$skills,
            'image' => $image,
            'individualProfile' =>$individualProfile
        ];
    }
}
