<?php

namespace App\Services\UserManagement;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Organization;
use App\Models\LovType;

class OrganizationService
{
    /**
     * Get skilled individuals query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getOrganizations($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $organizations = Organization::where('step', 6)
        ->with(['images', 'products'])
        ->applyFilter($request)
        ->orderBy($sortBy, $sortOrder)
        ->paginate($records);

        $organizations->getCollection()->transform(function ($org) {
            if ($org->ceo_email) {
                $ceo = User::where('email', $org->ceo_email)
                    ->with(['lovs' => function ($q) {
                        $q->where('lovs.lov_type_id', 4);
                    }])
                    ->first();
                $org->ceo = $ceo;
            }
            return $org;
        });

        return $organizations;
    }

    public function sendInvitation(string $email)
    {
        Mail::raw("You are invited to join as a Organization. Click the link to register.", function ($message) use ($email) {
            $message->to($email)
                ->subject("Invitation to Join Platform");
        });

        return true;
    }

    public function getOrganization($org_id)
    {
        $organization = Organization::with(['user.images', 'products', 'user.skills', 'user.lovs'])
            ->where('id', $org_id)
            ->first();

        return $organization;
    }

    public function update($request)
    {
        $organization = Organization::findOrFail($request->org_id);
        $user = User::where('email', $organization->ceo_email)->first();
        if ($user) {
            $user->update(['is_active' => $request->is_verified]);
        }
        $organization->update(['is_verified' => $request->is_verified]);
    }

    public function updateStatus($data)
    {
        $organization = Organization::findOrFail($data['org_id']);
        $is_verified = $data['action'] === 'approve' ? 1 : 0;
        
        $user = User::where('email', $organization->ceo_email)->first();
        if ($user) {
            $user->update(['is_active' => $is_verified]);
        }
        $organization->update(['is_verified' => $is_verified]);
        
        return $organization;
    }

    public function deleteOrganization($id)
    {
        $organization = Organization::findOrFail($id);
        $user = User::where('email', $organization->ceo_email);
        $user->delete();
        $organization->delete();
    }
}