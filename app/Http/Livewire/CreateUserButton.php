<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateUserButton extends Component
{
    public $creatingUser = false;

    public $listeners = ['closeCreateDialog'];

    public function openCreateDialog()
    {
        $this->creatingUser = true;
        $this->emit('openCreateDialog');
    }

    public function closeCreateDialog()
    {
        $this->creatingUser = false;
    }

    public function render()
    {
        return view('admin.users.includes.partials.create-user-button');
    }
}
