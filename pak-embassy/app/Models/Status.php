<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const IN_REVIEW = 'in-review';
    
    protected $fillable = [
        'name',
        'slug'
    ];

    public function lead()
    {
        return $this->hasMany(Lead::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public static function getStatusIdBySlug($slug)
    {
        return self::where('slug',$slug)?->first()?->id ?? null;
    }
}
