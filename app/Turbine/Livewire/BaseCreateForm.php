<?php

namespace App\Turbine\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Turbine\Livewire\Concerns\HandlesCreateDialogInteraction;

abstract class BaseCreateForm extends Component
{
    use AuthorizesRequests;
    use HandlesCreateDialogInteraction;

    public $listeners = [
        'createDialog',
        'closeCreateDialog',
    ];
}
