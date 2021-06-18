<?php

namespace App\Core\Livewire;

use App\Core\Livewire\Concerns\HandlesCreateDialogInteraction;
use App\Core\Livewire\Concerns\InteractsWithDialog;
use Livewire\Component;

abstract class BaseCreateButton extends Component
{
    use InteractsWithDialog,
        HandlesCreateDialogInteraction;

    public $value;

    public $params;

    public function mount($value = null): void
    {
        if ($value) {
            $this->value = $value;
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.create-button');
    }
}
