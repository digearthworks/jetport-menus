<?php

namespace App\Models\Traits\Method;

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

    public function getGroupMetaForItems()
    {
        return $this->isParentMenu() ? ['group' => 'main', 'menu_id' => $this->id] : [];
    }
}
