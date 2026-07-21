<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoworkingSpace extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'space_id',
        'name',
        'phone',
        'email',
        'starting_price',
        'month_rentals',
        'people',
        'space_type',
        'location',
        'is_active',
        'space_overview',
        'space_description',
        'space_amenities',
        'embed_map_url'
    ];

    public function scopeApplyFilter($query, $request)
    {
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->filled('starting_price')) {
            $query->where('starting_price', 'like', '%' . $request->starting_price . '%');
        }
        if ($request->filled('people')) {
            $query->where('people', 'like', '%' . $request->people . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $query;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function bookingRequests()
    {
        return $this->hasMany(BookingRequest::class);
    }

    public function newRequestsCount()
    {
        return $this->bookingRequests()
            ->where(function($query) {
                $query->whereNull('status_id')
                    ->orWhereHas('status', function($q) {
                        $q->where('slug', 'pending');
                    });
            })
            ->count();
    }
}
