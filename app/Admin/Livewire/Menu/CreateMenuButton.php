<?php

namespace App\Admin\Livewire\Menu;

use App\Http\Livewire\BaseCreateButton;

class CreateMenuButton extends BaseCreateButton
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
        return view('admin.menus.create-menu-button');
    }
}
