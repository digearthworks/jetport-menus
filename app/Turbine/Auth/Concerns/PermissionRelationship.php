<?php

namespace App\Turbine\Auth\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Turbine\Auth\Models\Permission;

trait PermissionRelationship
{
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'parent_id')->with('parent');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Permission::class, 'parent_id')->with('children');
    }
}
