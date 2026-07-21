<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_logo',
        'favicon',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}