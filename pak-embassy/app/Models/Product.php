<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'organization_id',
        'name',
        'capabilities',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}