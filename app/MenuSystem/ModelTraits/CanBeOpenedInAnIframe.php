<?php

namespace App\MenuSystem\ModelTraits;

trait CanBeOpenedInAnIframe
{
    public function makeIframe()
    {
        $this->update(['iframe' => 1]);
    }

    public function unmakeIframe()
    {
        $this->update(['iframe' => 0]);
    }

    /** -------------ACCESSORS------------------*/

    public function getIsIFrameAttribute()
    {
        return ($this->attributes['iframe'] ?? 0) == 1;
    }
}
