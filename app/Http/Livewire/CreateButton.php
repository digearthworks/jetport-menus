<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class CreateButton extends Component
{
    public $creating = false;

    public $value;

    public $listeners = ['closeCreateDialog'];

    public $params = [];

    public function openCreateDialog()
    {
        $this->creating = true;
        $this->emit('openCreateDialog', $this->params);
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
