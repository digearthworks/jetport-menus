<?php

namespace App\Turbine\Livewire\Concerns;

trait HandlesReactivateDialogInteraction
{
    use HasModel;

    public $confirmingReactivate = false;

    public function confirmReactivate($resourceId): void
    {
        $this->modelId = $resourceId;
        $this->confirmingReactivate = true;
        $this->dispatchBrowserEvent('showing-confirm-restore-modal');
    }

    public function closeConfirmReactivate(): void
    {
        $this->confirmingReactivate = false;
        $this->dispatchBrowserEvent('closing-confirm-restore-modal');
    }
}
