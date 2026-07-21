<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualProfile extends Model
{
    protected $fillable = [
        'user_id',
        'passport_no',
        'iqama_id',
        'linkedin_url',
        'additional_skills',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
