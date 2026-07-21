<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function subModules(): HasMany
    {
        return $this->hasMany(Module::class, 'parent_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function parentModule(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'module_id', 'id');
    }
}
