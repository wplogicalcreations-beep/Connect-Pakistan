<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;
    protected $fillable = [
        'name',
        'guard_name',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function scopeApplyFilter($query, array $filters)
    {
        $filters = collect($filters);
        if ($filters->get('search_by_name'))
            $query->WhereName($filters->get('search_by_name'));
    }
    public function scopeWhereName($query, $name)
    {
        $query->where('name', 'LIkE', $name . '%');
    }
}
