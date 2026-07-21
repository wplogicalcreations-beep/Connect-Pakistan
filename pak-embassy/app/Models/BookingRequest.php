<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'coworking_space_id',
        'user_id',
        'status_id',
        'people_count',
        'space_type',
        'duration',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'company_name',
        'estimated_start_date',
        'additional_notes',
    ];

    protected $casts = [
        'estimated_start_date' => 'date',
    ];

    public function coworkingSpace()
    {
        return $this->belongsTo(CoworkingSpace::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApplyFilter($query, $request)
    {
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('space_type')) {
            $query->where('space_type', $request->space_type);
        }

        if ($request->filled('people_count')) {
            $query->where('people_count', $request->people_count);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        // Filter by related coworkingSpace fields
        if ($request->filled('coworking_name') || $request->filled('coworking_email') || $request->filled('coworking_phone')) {
            $query->whereHas('coworkingSpace', function ($q) use ($request) {
                if ($request->filled('coworking_name')) {
                    $q->where('name', 'like', '%' . $request->coworking_name . '%');
                }
                if ($request->filled('coworking_email')) {
                    $q->where('email', 'like', '%' . $request->coworking_email . '%');
                }
                if ($request->filled('coworking_phone')) {
                    $q->where('phone', 'like', '%' . $request->coworking_phone . '%');
                }
            });
        }

        return $query;
    }

    public function getDurationInMonthsAttribute()
    {
        return match ($this->duration) {
            '0-3'   => 3,
            '3-6'   => 6,
            '6-12'  => 12,
            '12+'   => 18, // or pick a default like 12/24 depending on business rule
            default => 0,
        };
    }

    public function getEndDateAttribute()
    {
        if (!$this->estimated_start_date || !$this->duration_in_months) {
            return null;
        }

        return $this->estimated_start_date->copy()->addMonths($this->duration_in_months);
    }

    public function getRemainingDaysAttribute()
    {
        if (!$this->end_date) {
            return null;
        }

        return Carbon::now()->diffInDays($this->end_date, false);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
