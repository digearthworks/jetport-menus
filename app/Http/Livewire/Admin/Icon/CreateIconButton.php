<?php

namespace App\Http\Livewire\Admin\Icon;

use App\Http\Livewire\BaseCreateButton;

class CreateIconButton extends BaseCreateButton
{
    public function openCreateDialog(): void
    {
        $this->creatingResource = true;
        $this->emit('createDialog');
    }
}
