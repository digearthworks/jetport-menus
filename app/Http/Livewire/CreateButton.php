<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateButton extends Component
{
    public $creating = false;

    public $listeners = ['closeCreateDialog'];

    public function openCreateDialog()
    {
        $this->creating = true;
        $this->emit('openCreateDialog');
    }

    public function closeCreateDialog()
    {
        $this->creating = false;
    }

    public function render()
    {
        return view('admin.includes.partials.create-button');
    }
}
