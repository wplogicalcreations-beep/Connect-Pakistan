<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'type',
        'path',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
