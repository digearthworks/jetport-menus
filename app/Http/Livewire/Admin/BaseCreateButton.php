<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Concerns\HandlesCreateDialogInteraction;
use App\Http\Livewire\Concerns\InteractsWithDialogs;
use Livewire\Component;

abstract class BaseCreateButton extends Component
{
    use InteractsWithDialogs,
        HandlesCreateDialogInteraction;

    public $value;

    public function mount($value = null)
    {
        if ($value) {
            $this->value = $value;
        }
    }

    public function render()
    {
        return view('admin.includes.partials.create-button');
    }
}
