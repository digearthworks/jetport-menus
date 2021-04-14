<?php

namespace App\Models\Traits\Relationship;

use App\Models\Menu;
use App\Models\PasswordHistory;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->morphMany(PasswordHistory::class, 'model');
    }


    public function bookmarks()
    {
        return $this->morphToMany(Menu::class, 'menuable')->withTimestamps()->wherePivot('menuable_group', 'bookmarks')->with('children', 'icons')->orderBy('sort');
    }

    public function menus()
    {
        return $this->morphToMany(Menu::class, 'menuable')->withTimestamps()->with('children', 'icon')->orderBy('sort');
    }

    public function hotlinks()
    {
        return $this->morphToMany(Menu::class, 'menuable')->with('children', 'icons')->where('group', 'hotlinks')->orderBy('sort');
    }
}
