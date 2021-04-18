<?php

namespace App\MenuSystem\ModelTraits;

trait CanBeActivated
{
    public function activate()
    {
        $this->update(['active' => 1]);
    }

    public function deactivate()
    {
        $this->update(['active' => 0]);
    }

    /** -------------ACCESSORS------------------*/

    public function getIsActiveAttribute()
    {
        if (isset($this->attributes['active']) && $this->attributes['active'] == 1) {
            return true;
        }

        return false;
    }
}
