<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'experienceable_id',
        'experienceable_type',
        'job_title',
        'job_type',
        'company_name',
        'your_location',
        'company_location',
        'country_id',
        'start_date',
        'end_date',
        'currently_working',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'currently_working' => 'boolean',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Polymorphic relation
    public function experienceable()
    {
        return $this->morphTo();
    }
}
