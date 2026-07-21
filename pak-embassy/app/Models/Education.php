<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;
    protected $table = 'educations'; // 👈 force it to use the right table
    protected $fillable = [
        'educationable_id',
        'educationable_type',
        'degree_type',
        'institution',
        'degree_name',
        'country_id',
        'start_date',
        'end_date',
        'currently_studying',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'currently_studying' => 'boolean',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Polymorphic relation
    public function educationable()
    {
        return $this->morphTo();
    }
}
