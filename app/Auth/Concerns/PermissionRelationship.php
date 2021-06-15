<?php

namespace App\Auth\Concerns;

use App\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
