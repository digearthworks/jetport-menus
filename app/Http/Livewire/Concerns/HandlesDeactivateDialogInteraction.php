<?php

namespace App\Http\Livewire\Concerns;

trait HandlesDeactivateDialogInteraction
{
    use HasModel;

    public $confirmingDeactivate = false;

    public $listeners = [
        'confirmDeactivate',
        'closeConfirmDeactivate',
    ];

    public function confirmDeactivate($resourceId)
    {
        $this->modelId = $resourceId;
        $this->confirmingDeactivate = true;
        $this->dispatchBrowserEvent('showing-confirm-restore-modal');
    }

    public function closeConfirmDeactivate()
    {
        $this->confirmingDeactivate = false;
        $this->dispatchBrowserEvent('closing-confirm-restore-modal');
    }

}
