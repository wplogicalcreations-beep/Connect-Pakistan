<?php

namespace App\Http\Controllers;

use App\Models\Lov;
use App\Models\LovType;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function events(Request $request)
    {
        return view('super-admin.events.index');
    }

    public function departments(Request $request)
    {
        return view('super-admin.Acl.skills.index');
    }

    public function saveRole(Request $request)
    {
        return view('super-admin.Acl.roles.create');
    }

    public function createMatchMakingEvent(Request $request)
    {
        return view('super-admin.match-making.create-match-making-event');
    }

    public function coWorkingSpace(Request $request)
    {
        return view('super-admin.co-working-space.index');
    }

    public function createCoWorkingSpace(Request $request)
    {
        return view('super-admin.co-working-space.create');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userRole = Auth::user()->roles->first()->name ?? null;
            switch ($userRole) {
                case 'organization_admin':
                    return redirect()->route('company.dashboard');
                case 'customer':
                    return redirect()->route('user.dashboard');
            }
        }

        return view('login');
    }

    public function organizationSignUp(Request $request)
    {
        $industryAreas = Lov::lovsByType(LovType::INDUSTRY_TYPE_KSA);
        $serviceDomains = Lov::lovsByType(LovType::SERVICE_DOMAIN);
        $skills = Skill::where('is_active', true)->where('type', 'business')->get();

        return view('organization-signup.index', compact('industryAreas', 'serviceDomains', 'skills'));
    }

    public function diasporaSignup(Request $request)
    {
        return view('diaspora-signup.index');
    }

// User dashboard
    public function userDashboard(Request $request)
    {
        return view('user-dashboard.dashboard.index');
    }

    public function knknowledgeArea(Request $request)
    {
        return view('user-dashboard.dashboard.knowledge-area');
    }

    public function discoverJob(Request $request)
    {
        return view('user-dashboard.job-board.discover-job');
    }

    public function detailJob(Request $request)
    {
        return view('user-dashboard.job-board.job-detail');
    }

    public function jobApply(Request $request)
    {
        return view('user-dashboard.job-board.job-apply');
    }

    public function appliedJob(Request $request)
    {
        return view('user-dashboard.job-board.applied-job');
    }

    public function publicEvent(Request $request)
    {
        return view('user-dashboard.event.public-event');
    }

    public function eventDetail(Request $request)
    {
        return view('user-dashboard.event.event-detail');
    }

    public function yourEvent(Request $request)
    {
        return view('user-dashboard.event.your-event');
    }

    public function workSpace(Request $request)
    {
        return view('user-dashboard.work-space.co-work-space');
    }

    public function workSpaceDetail(Request $request)
    {
        return view('user-dashboard.work-space.work-space-detail');
    }

    public function profile(Request $request)
    {
        return view('user-dashboard.profile');
    }

    // Company dashboard
    public function companyDashboard(Request $request)
    {
        return view('company-dashboard.dashboard.index');
    }

    public function companyknknowledgeArea(Request $request)
    {
        return view('company-dashboard.dashboard.knowledge-area');
    }

    public function companydiscoverJob(Request $request)
    {
        return view('company-dashboard.job-board.discover-job');
    }

    public function companydetailJob(Request $request)
    {
        return view('company-dashboard.job-board.job-detail');
    }

    public function companyjobApply(Request $request)
    {
        return view('company-dashboard.job-board.job-apply');
    }

    public function companyappliedJob(Request $request)
    {
        return view('company-dashboard.job-board.applied-job');
    }

    public function companypostJob(Request $request)
    {
        return view('company-dashboard.job-board.post-job');
    }

    public function companypublicEvent(Request $request)
    {
        return view('company-dashboard.event.public-event');
    }

    public function companyeventDetail(Request $request)
    {
        return view('company-dashboard.event.event-detail');
    }

    public function companyyourEvent(Request $request)
    {
        return view('company-dashboard.event.your-event');
    }

    public function companyworkSpace(Request $request)
    {
        return view('company-dashboard.work-space.co-work-space');
    }

    public function companyworkSpaceDetail(Request $request)
    {
        return view('company-dashboard.work-space.work-space-detail');
    }

    public function companyprofile(Request $request)
    {
        $user = User::find(Auth::id());
        $organization = $user->organization ?? Organization::where('ceo_email',$user->email)->first();
        return view('company-dashboard.profile',compact('user','organization'));
    }
}
