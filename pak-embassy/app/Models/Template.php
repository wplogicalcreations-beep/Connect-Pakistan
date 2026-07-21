<?php

namespace App\Models;

use App\Models\TemplatePageSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'keys',
        'template_file_url',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function setting()
    {
        return $this->hasOne(TemplatePageSetting::class, 'template_id');
    }

    // TODO: Fix later. setting() not changed as it will used on multiple location
    public function settings()
    {
        return $this->hasMany(TemplatePageSetting::class, 'template_id');
    }
}