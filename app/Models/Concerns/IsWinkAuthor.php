<?php

namespace App\Models\Concerns;

use Wink\WinkAuthor;

trait IsWinkAuthor
{
    /**
     * @return string
     */
    public function isWinkAuthor(): bool
    {
        if (!config('template.cms.cms') || !config('template.cms.driver') === 'wink') {
            return false;
        }

        return in_array($this->email, WinkAuthor::all()->pluck('email')->toArray()) && $this->canEditContent();
    }
}
