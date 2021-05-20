<?php

namespace App\Http\Livewire\Concerns;

trait HandlesReactivateDialogInteraction
{
    use HasModel;

    public $confirmingReactivate = false;

    public function confirmReactivate($resourceId)
    {
        $this->modelId = $resourceId;
        $this->confirmingReactivate = true;
        $this->dispatchBrowserEvent('showing-confirm-restore-modal');
    }

    public function closeConfirmReactivate()
    {
        $this->confirmingReactivate = false;
        $this->dispatchBrowserEvent('closing-confirm-restore-modal');
    }
}
