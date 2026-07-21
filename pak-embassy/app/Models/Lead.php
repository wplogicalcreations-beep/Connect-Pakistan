<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lead_type',
        'status_id',
        'event_name',
        'company_name',
        'email',
        'phone',
        'description',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
