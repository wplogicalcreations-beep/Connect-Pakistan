<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lov extends Model
{
    protected $fillable = [
        'name',
        'lov_type_id',
        'slug',
        'is_active',
    ];

    public function scopeOfType($query, string $slug)
    {
        return $query->whereHas('lovType', fn($q) => $q->where('slug', $slug));
    }

    public function lovType()
    {
        return $this->belongsTo(LovType::class);
    }

    public static function lovsByType($type)
    {
       return self::whereHas('lovType', function ($query) use ($type) {
        $query->where('slug', $type);
        })->get();
    }

    public function users()
    {
        return $this->morphToMany(
            User::class,
            'attribute',
            'user_attributes',
            'attribute_id',
            'user_id'
        )->withPivot('lov_type_id');
    }

    public function scopeApplyFilter($query, $request)
    {
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $query;
    }

}
