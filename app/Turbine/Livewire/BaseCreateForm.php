<?php

namespace App\Turbine\Livewire;

use App\Turbine\Livewire\Concerns\HandlesCreateDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

abstract class BaseCreateForm extends Component
{
    use AuthorizesRequests;
    use HandlesCreateDialogInteraction;

    public $listeners = [
        'createDialog',
        'closeCreateDialog',
    ];
}
