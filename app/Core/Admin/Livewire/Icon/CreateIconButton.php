<?php

namespace App\Core\Admin\Livewire\Icon;

use App\Core\Livewire\BaseCreateButton;

class CreateIconButton extends BaseCreateButton
{
    public function openCreateDialog(): void
    {
        $this->creatingResource = true;
        $this->emit('createDialog');
    }
}
