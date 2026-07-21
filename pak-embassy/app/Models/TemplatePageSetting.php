<?php

namespace App\Models;

use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplatePageSetting extends Model
{
    use HasFactory;

    const COMMON_CONTENT = [
        'FooterSection',
        'CallToAction',
        'NavbarSection',
        'old_Logo',
        'Logo'
    ];

    protected $fillable = [
        "name",
        "content",
        "template_id",
        "created_by",
        "status",
        "template_page",
        "template_image"
    ];

    public function template()
    {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }
}