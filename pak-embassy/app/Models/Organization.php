<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
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
        'representative_email',
        'company_type',
        'years_of_experience',
        'no_of_staff',
        'has_company_certificate',
        'reference',
        'no_of_projects',
        'reference_project',
        'staff_certification',
        'ip',
        'step',
        'is_verified'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApplyFilter($query, $request)
    {
        // name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // website_url
        if ($request->filled('website_url')) {
            $query->where('website_url', 'like', '%' . $request->website_url . '%');
        }

        // secp_registration_number
        if ($request->filled('secp_registration_number')) {
            $query->where('secp_registration_number', 'like', '%' . $request->secp_registration_number . '%');
        }

        // pseb_registration_number
        if ($request->filled('pseb_registration_number')) {
            $query->where('pseb_registration_number', 'like', '%' . $request->pseb_registration_number . '%');
        }

        // pasha_registration_number
        if ($request->filled('pasha_registration_number')) {
            $query->where('pasha_registration_number', 'like', '%' . $request->pasha_registration_number . '%');
        }

        // ceo_name
        if ($request->filled('ceo_name')) {
            $query->where('ceo_name', 'like', '%' . $request->ceo_name . '%');
        }

        // ceo_contact
        if ($request->filled('ceo_contact')) {
            $query->where('ceo_contact', 'like', '%' . $request->ceo_contact . '%');
        }

        // ceo_email
        if ($request->filled('ceo_email')) {
            $query->where('ceo_email', 'like', '%' . $request->ceo_email . '%');
        }

        // has_ksa_registered_company (exact match)
        if ($request->filled('has_ksa_registered_company')) {
            $query->where('has_ksa_registered_company', $request->has_ksa_registered_company);
        }

        // saudi_entity_name
        if ($request->filled('saudi_entity_name')) {
            $query->where('saudi_entity_name', 'like', '%' . $request->saudi_entity_name . '%');
        }

        // representative_name
        if ($request->filled('representative_name')) {
            $query->where('representative_name', 'like', '%' . $request->representative_name . '%');
        }

        // representative_contact
        if ($request->filled('representative_contact')) {
            $query->where('representative_contact', 'like', '%' . $request->representative_contact . '%');
        }

        // representative_email
        if ($request->filled('representative_email')) {
            $query->where('representative_email', 'like', '%' . $request->representative_email . '%');
        }

        // company_type
        if ($request->filled('company_type')) {
            $query->where('company_type', 'like', '%' . $request->company_type . '%');
        }

        // years_of_experience (exact match)
        if ($request->filled('years_of_experience')) {
            $query->where('years_of_experience', $request->years_of_experience);
        }

        // no_of_staff (exact match)
        if ($request->filled('no_of_staff')) {
            $query->where('no_of_staff', $request->no_of_staff);
        }

        // has_company_certificate (exact match)
        if ($request->filled('has_company_certificate')) {
            $query->where('has_company_certificate', $request->has_company_certificate);
        }

        // reference
        if ($request->filled('reference')) {
            $query->where('reference', 'like', '%' . $request->reference . '%');
        }

        // no_of_projects (exact match)
        if ($request->filled('no_of_projects')) {
            $query->where('no_of_projects', $request->no_of_projects);
        }

        // reference_project
        if ($request->filled('reference_project')) {
            $query->where('reference_project', 'like', '%' . $request->reference_project . '%');
        }

        // staff_certification
        if ($request->filled('staff_certification')) {
            $query->where('staff_certification', 'like', '%' . $request->staff_certification . '%');
        }

        // created_at range
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $query;
    }

}