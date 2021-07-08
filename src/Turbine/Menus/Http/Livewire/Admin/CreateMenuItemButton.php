<?php

namespace Turbine\Menus\Http\Livewire\Admin;

use Turbine\Livewire\BaseCreateButton;

class CreateMenuItemButton extends BaseCreateButton
{
    public function openCreateDialog(): void
    {
        $this->creatingResource = true;
        $this->emit('createDialog', $this->params);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.create-menu-item-button');
    }
}
