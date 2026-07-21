<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Department;
use App\Models\Role;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected static function boot()
    {
        parent::boot();

        // static::creating(function ($model) {
        //     if (empty($model->{$model->getKeyName()})) {
        //         $model->{$model->getKeyName()} = \Str::uuid()->toString();
        //     }
        // });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'passcode',
        'nid',
        'department_id',
        'step',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'passcode',
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'passcode' => 'hashed',
            'password' => 'hashed',
        ];
    }

    public function individualProfile()
    {
        return $this->hasOne(IndividualProfile::class);
    }

    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function lovs()
    {
        return $this->morphedByMany(
            Lov::class,
            'attribute',
            'user_attributes',
            'user_id',
            'attribute_id'
        )->withPivot('lov_type_id');
    }

    public function skills()
    {
        return $this->morphedByMany(
            Skill::class,
            'attribute',
            'user_attributes',
            'user_id',
            'attribute_id'
        );
    }

    public function level()
    {
        return $this->lovs()->wherePivot('lov_type_id', function ($query) {
            $query->select('id')
                ->from('lov_types')
                ->where('slug', LovType::LEVEL);
        });
    }

    public function influence_ability()
    {
        return $this->lovs()->wherePivot('lov_type_id', function ($query) {
            $query->select('id')
                ->from('lov_types')
                ->where('slug', LovType::INFLUENCE_ABILITY);
        });
    }

    public function industry_area()
    {
        return $this->lovs()->wherePivot('lov_type_id', function ($query) {
            $query->select('id')
                ->from('lov_types')
                ->where('slug', LovType::INDUSTRY_AREA);
        });
    }

    public function work_domain()
    {
        return $this->lovs()->wherePivot('lov_type_id', function ($query) {
            $query->select('id')
                ->from('lov_types')
                ->where('slug', LovType::WORK_DOMAIN);
        });
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public static function getByRoles(array $roles)
    {
        return self::query()->role($roles)->get();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithRoles($query, array $roles)
    {
        return $query->role($roles);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'enrollments')
            ->withTimestamps();
    }

    public function attendedEvents()
    {
        return $this->belongsToMany(Event::class, 'enrollments')
            ->where('end_date', '<', now())
            ->withTimestamps();
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class, 'organization_id');
    }


    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0] ?? '';
    }

    // Accessor for last name
    public function getLastNameAttribute()
    {
        $parts = explode(' ', $this->name);
        array_shift($parts); // remove first part
        return implode(' ', $parts) ?: '';
    }

    public function experiences()
    {
        return $this->morphMany(Experience::class, 'experienceable');
    }

    public function educations()
    {
        return $this->morphMany(Education::class, 'educationable');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function receivedApplications()
    {
        return $this->hasManyThrough(
            JobApplication::class,
            JobPost::class,
            'organization_id', // FK on JobPost
            'job_post_id',     // FK on JobApplication
            'id',              // PK on User
            'id'               // PK on JobPost
        );
    }

    public function spaceRequests()
    {
        return $this->hasMany(BookingRequest::class);
    }

    public function latestActiveBookingRequest()
    {
        return $this->hasOne(BookingRequest::class)
            ->whereDate('estimated_start_date', '<=', now())
            ->orderBy('estimated_start_date', 'desc');
    }

    public function scopeApplyFilter($query, $request)
    {
        // Filter by name (partial match)
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by phone (partial match)
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        // Filter by email (partial match)
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Filter by created_at range
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $query;
    }

}
