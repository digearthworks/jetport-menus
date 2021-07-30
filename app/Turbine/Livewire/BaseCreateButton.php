<?php

namespace App\Turbine\Livewire;

use App\Turbine\Livewire\Concerns\HandlesCreateDialogInteraction;
use App\Turbine\Livewire\Concerns\InteractsWithDialog;
use Livewire\Component;

abstract class BaseCreateButton extends Component
{
    use InteractsWithDialog;
    use HandlesCreateDialogInteraction;

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
        return view('core.utils.create-button');
    }
}
