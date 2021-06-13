<?php

namespace App\Http\Livewire\Concerns;

trait HandlesCreateDialogInteraction
{
    public $creatingResource = false;

    /**
     * @return void
     */
    public function createDialog()
    {
        $this->creatingResource = true;
        $this->dispatchBrowserEvent('showing-create-modal');
    }

    public function closeCreateDialog(): void
    {
        $this->creatingResource = false;
        $this->dispatchBrowserEvent('closing-create-modal');
    }
}
