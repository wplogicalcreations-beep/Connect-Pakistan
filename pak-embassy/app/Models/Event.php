<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'event_id',
        'name',
        'status_id',
        'domain_id',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'meeting_link',
        'event_type',
        'event_mode',
        'location',
        'city',
        'event_mom',
        'event_activities',
        'event_overview',
        'event_agenda',
        'event_format',
        'embed_map_url',
        'event_mom_detail'
    ];

    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')
                    ->withTimestamps();
    }

    public function actionItems()
    {
        return $this->hasMany(ActionItem::class);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('event_type', $type);
    }

    public function scopeApplyFilter($query, $request)
    {
        // Filter by name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by status relation
        if ($request->filled('status')) {
            $query->whereHas('status', function ($q) use ($request) {
                $q->where('name', $request->status); // or replace 'name' with the field in status table
            });
        }

        // Filter by event_id
        if ($request->filled('event_id')) {
            $query->where('id', $request->event_id);
        }

        // Filter by event_type
        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by meeting link
        if ($request->filled('meeting_link')) {
            $query->where('meeting_link', 'like', '%' . $request->meeting_link . '%');
        }

        // Filter by start date
        if ($request->filled('start_date')) {
            $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
            $query->whereDate('start_date', $startDate);
        }

        // Filter by start time
        if ($request->filled('start_time')) {
            $query->whereTime('start_time', $request->start_time);
        }

        // Filter by end date
        if ($request->filled('end_date')) {
            $endDate = Carbon::parse($request->end_date)->format('Y-m-d');
            $query->whereDate('end_date', $endDate);
        }

        // Filter by end time
        if ($request->filled('end_time')) {
            $query->whereTime('end_time', $request->end_time);
        }

        // Filter by created_at range
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from = Carbon::parse($request->from_date)->startOfDay()->format('Y-m-d H:i:s');
            $to   = Carbon::parse($request->to_date)->endOfDay()->format('Y-m-d H:i:s');

            $query->whereBetween('created_at', [$from, $to]);
        }

        return $query;
    }


}
