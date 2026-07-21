<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplicationDetail extends Model
{
    protected $fillable = [
        'job_application_id',
        'department_id',
        'name',
        'email',
        'phone',
        'skills',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'linkedin_url',
        'portfolio_link',
        'resume',
        'additional_info',
    ];


    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
