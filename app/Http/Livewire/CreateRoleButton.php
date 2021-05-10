<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateRoleButton extends Component
{
    public $creatingRole = false;

    public $listeners = ['closeCreateDialogForRole'];

    public function openCreateDialog()
    {
        $this->creatingRole = true;
        $this->emit('openCreatorForRole');
    }

    public function closeCreateDialogForRole()
    {
        $this->creatingRole = false;
    }

    public function render()
    {
        return view('admin.roles.includes.partials.create-role-button');
    }
}
