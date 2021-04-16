<?php

namespace App\Models\Traits\Relationship;

use App\Models\Menu;

trait UserRelationship
{
    public function bookmarks()
    {
        return $this->morphedMenuable()->withTimestamps()->wherePivot('menuable_group', 'bookmarks');
    }

    public function menus()
    {
        return $this->morphedMenuable()->withTimestamps();
    }

    public function hotlinks()
    {
        return $this->morphedMenuable()->where('group', 'hotlinks');
    }

    private function morphedMenuable()
    {
        return $this->morphToMany(Menu::class, 'menuable')->orderBy('sort')->with('children', 'icon');
    }
}
