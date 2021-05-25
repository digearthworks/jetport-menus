<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\Admin\BaseCreateButton;

class CreateMenuButton extends BaseCreateButton
{
    public function openCreateDialog()
    {
        $this->creatingResource = true;
        $this->emit('createDialog', $this->params);
    }

    public function render()
    {
        return view('admin.menus.includes.partials.create-menu-button');
    }
}
