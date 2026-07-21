<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\Guard;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    /**
     * Find or create permission by its name (and optionally guardName).
     *
     * @param string $name
     * @param string|null $guardName
     *
     * @return \Spatie\Permission\Contracts\Permission
     */
    public static function findOrCreate(string $name, $guardName = null, $parent_id = null): PermissionContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);
        $permission = static::getPermission(['name' => $name, 'guard_name' => $guardName, 'module_id' => $parent_id]);

        if (!$permission) {
            return static::query()->create(['name' => $name, 'guard_name' => $guardName, 'module_id' => $parent_id]);
        }

        return $permission;
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
