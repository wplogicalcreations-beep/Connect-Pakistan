<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmploymentAreaRequest;
use App\Http\Requests\EmploymentInfoRequest;
use App\Http\Requests\FinalizeRegistrationRequest;
use App\Http\Requests\PersonalInfoRequest;
use App\Models\Lov;
use App\Models\LovType;
use App\Models\Skill;
use App\Models\User;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    protected $registrationService;
    public function __construct(RegistrationService $registrationService) 
    {
        $this->registrationService = $registrationService;
    }

    public function diasporaRegistration()
    {

        $levels = Lov::lovsByType(LovType::LEVEL);
        $influence_abilities = Lov::lovsByType(LovType::INFLUENCE_ABILITY);
        $work_domains = Lov::lovsByType(LovType::WORK_DOMAIN);
        $industry_areas = Lov::lovsByType(LovType::INDUSTRY_AREA);
        $skills = Skill::where('is_active', true)->where('type', 'individual')->get();
        return view('diaspora-signup.index',compact('levels','influence_abilities','work_domains','industry_areas','skills'));
    }

    public function storePersonalInfo(PersonalInfoRequest $request)
    {
        try{
            $user = $this->registrationService->storePersonalInfo($request);
            $this->individualDetails($user);
            return response()->json(['user_id' => $user->id, 'userDetails'=>$user, 'message' => 'Step 1 saved.']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function employmentInfo()
    {
         return view('diaspora-signup.index');
    }

    public function storeEmploymentInfo(EmploymentInfoRequest $request)
    {
        try{
            $user = User::find($request->user_id);
            $this->registrationService->storeEmploymentInfo($request,$user);
            $this->individualDetails($user);
            return response()->json(['user_id' => $user->id,'userDetails'=>$user,'message' => 'Step 2 saved.']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeEmploymentArea(EmploymentAreaRequest $request)
    {
        try{

            $user = User::find($request->user_id);
            $this->registrationService->storeEmploymentArea($request, $user);
            $this->individualDetails($user);
            return response()->json(['user_id' => $user->id, 'userDetails'=>$user, 'message' => 'Step 3 saved.']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function finalizeRegistration(FinalizeRegistrationRequest $request)
    {
        try{
            $user = User::find($request->user_id);
            $this->registrationService->finalizeRegistration($request, $user);
            $completed = 1;
            return response()->json(['message' => 'Registration complete.','completed'=>$completed]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function individualDetails($user)
    {
        try{
            $user = $this->registrationService->details($user);
            return response()->json(['user'=>$user]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

}
