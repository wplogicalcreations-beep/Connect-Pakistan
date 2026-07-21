<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActionItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'event_id',
        'action',
        'description',
        'assigned_to',
        'due_date',
        'status',
        'comment',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Get the event that owns the action item.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user assigned to the action item.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'completed' => 'bg-success',
            'in_progress' => 'bg-warning',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'completed' => 'Completed',
            'in_progress' => 'In Progress',
            'cancelled' => 'Cancelled',
            default => 'Pending',
        };
    }

    public function scopeApplyFilter($query, $request)
    {
        // Filter by created_at range
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $query;
    }
}
