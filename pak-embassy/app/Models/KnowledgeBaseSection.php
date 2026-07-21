<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeBaseSection extends Model
{
    protected $table = 'knowledge_base_sections';

    protected $fillable = [
        'knowledge_base_id',
        'name',
        'content'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
