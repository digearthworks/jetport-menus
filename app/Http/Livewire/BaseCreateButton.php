<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Concerns\HandlesCreateDialogInteraction;
use App\Http\Livewire\Concerns\InteractsWithDialog;
use Livewire\Component;

abstract class BaseCreateButton extends Component
{
    use InteractsWithDialog,
        HandlesCreateDialogInteraction;

    public $value;

    public $params;

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
