<?php

namespace App\Http\Livewire\Concerns;

trait HandlesDialogInteraction
{
    use HasModel;

    public $creatingResource = false;

    public $editingResource = false;

    public $confirmingDelete = false;

    public $confirmingRestore = false;

    public $confirmingDeactivate = false;

    public $confirmingReactivate = false;

    public $listeners = [
        'createDialog',
        'closeCreateDialog',
        'editDialog',
        'closeEditDialog',
        'confirmDelete',
        'closeConfirmDelete',
        'confirmRestore',
        'closeConfirmRestore',
        'confirmReactivate',
        'closeConfirmReactivate',
        'confirmDeactivate',
        'closeConfirmDeactivate',
    ];

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

    public function editDialog($resourceId, $params = null)
    {
        $this->editingResource = true;
        $this->dispatchBrowserEvent('showing-edit-modal');
    }

    public function closeEditDialog()
    {
        $this->editingResource = false;
        $this->dispatchBrowserEvent('closing-edit-modal');
    }

    public function confirmDelete($resourceId)
    {
        $this->modelId = $resourceId;
        $this->confirmingDelete = true;
        $this->dispatchBrowserEvent('showing-confirm-delete-modal');
    }

    public function closeConfirmDelete()
    {
        $this->confirmingDelete = false;
        $this->dispatchBrowserEvent('closing-confirm-delete-modal');
    }

    public function confirmRestore($resourceId)
    {
        $this->modelId = $resourceId;
        $this->confirmingRestore = true;
        $this->dispatchBrowserEvent('showing-confirm-restore-modal');
    }

    public function closeConfirmRestore()
    {
        $this->confirmingRestore = false;
        $this->dispatchBrowserEvent('closing-confirm-restore-modal');
    }

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
