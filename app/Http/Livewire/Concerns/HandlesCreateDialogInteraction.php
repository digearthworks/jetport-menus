<?php

namespace App\Http\Livewire\Concerns;

trait HandlesCreateDialogInteraction
{
    public $creatingResource = false;

    public function createDialog()
    {
        $this->creatingResource = true;
        $this->dispatchBrowserEvent('showing-create-modal');
    }

    public function closeCreateDialog()
    {
        $this->creatingResource = false;
        $this->dispatchBrowserEvent('closing-create-modal');
    }
}
