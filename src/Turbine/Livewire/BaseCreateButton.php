<?php

namespace Turbine\Livewire;

use Livewire\Component;
use Turbine\Livewire\Concerns\HandlesCreateDialogInteraction;
use Turbine\Livewire\Concerns\InteractsWithDialog;

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
