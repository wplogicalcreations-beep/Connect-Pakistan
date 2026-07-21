<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeBase extends Model
{
    protected $table = 'knowledge_bases';

    protected $fillable = [
        'page_name',
        'heading',
        'status_id'
    ];

    public function sections()
    {
        return $this->hasMany(KnowledgeBaseSection::class);
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function scopeApplyFilter($query, $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('page_name', 'like', '%' . $search . '%')
                ->orWhere('heading', 'like', '%' . $search . '%');
            });
        }
        if ($request->filled('page_name')) {
            $query->where('page_name', 'like', '%' . $request->page_name . '%');
        }
        if ($request->filled('heading')) {
            $query->where('heading', 'like', '%' . $request->heading . '%');
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $query;
    }
}
