<?php

namespace App\Turbine\Livewire\Concerns;

trait HandlesDeactivateDialogInteraction
{
    use HasModel;

    public $confirmingDeactivate = false;

    public function confirmDeactivate($resourceId): void
    {
        $this->modelId = $resourceId;
        $this->confirmingDeactivate = true;
        $this->dispatchBrowserEvent('showing-confirm-restore-modal');
    }

    public function closeConfirmDeactivate(): void
    {
        $this->confirmingDeactivate = false;
        $this->dispatchBrowserEvent('closing-confirm-restore-modal');
    }
}
