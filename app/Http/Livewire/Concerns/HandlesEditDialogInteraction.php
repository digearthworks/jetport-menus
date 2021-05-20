<?php

namespace App\Http\Livewire\Concerns;

trait HandlesEditDialogInteraction
{
    use HasModel;

    public $editingResource = false;

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

}
