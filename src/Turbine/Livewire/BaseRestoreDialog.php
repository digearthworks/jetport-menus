<?php

namespace Turbine\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Turbine\Livewire\Concerns\HandlesRestoreDialogInteraction;

class BaseRestoreDialog extends Component
{
    use AuthorizesRequests;
    use HandlesRestoreDialogInteraction;

    public $listeners = [
        'confirmRestore',
        'closeConfirmRestore',
    ];
}
