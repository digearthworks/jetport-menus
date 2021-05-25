<?php

namespace App\Http\Livewire\Concerns;

trait HandlesRestoreDialogInteraction
{
    use HasModel;

    public $confirmingRestore = false;

    public function confirmRestore($resourceId)
    {
        $this->withTrashed = true;
        $this->modelId = $resourceId;
        $this->confirmingRestore = true;
        $this->dispatchBrowserEvent('showing-confirm-restore-modal');
    }

    public function closeConfirmRestore()
    {
        $this->confirmingRestore = false;
        $this->dispatchBrowserEvent('closing-confirm-restore-modal');
    }
}
