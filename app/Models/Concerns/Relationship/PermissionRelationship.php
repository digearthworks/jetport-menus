<?php

namespace App\Models\Concerns\Relationship;

trait PermissionRelationship
{
    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id')->with('children');
    }
}
