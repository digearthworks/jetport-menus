<?php

namespace App\Models\Concerns\Relationship;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait PermissionRelationship
{

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->with('parent');
    }


    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->with('children');
    }
}
