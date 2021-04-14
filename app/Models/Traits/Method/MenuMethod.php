<?php

namespace App\Models\Traits\Method;

/**
 * Trait MenuMethod.
 */
trait MenuMethod
{
    public function activate()
    {
        $this->update(['active' => 1]);
    }

    public function deactivate()
    {
        $this->update(['active' => 0]);
    }

    public function makeIframe()
    {
        $this->update(['iframe' => 1]);
    }

    public function unmakeIframe()
    {
        $this->update(['iframe' => 0]);
    }

    public function getGroupMetaForItems(): array
    {
        if ($this->menu_id === null) {
            return ['group' => 'main', 'menu_id' => $this->id];
        }

        return [];
    }
}
