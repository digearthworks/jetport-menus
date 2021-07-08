<?php

namespace Turbine\Livewire\Concerns;

trait HandlesDeleteDialogInteraction
{
    use HasModel;

    public $confirmingDelete = false;

    public function confirmDelete($resourceId): void
    {
        $this->modelId = $resourceId;
        $this->confirmingDelete = true;
        $this->dispatchBrowserEvent('showing-confirm-delete-modal');
    }

    public function closeConfirmDelete(): void
    {
        $this->confirmingDelete = false;
        $this->dispatchBrowserEvent('closing-confirm-delete-modal');
    }
}
