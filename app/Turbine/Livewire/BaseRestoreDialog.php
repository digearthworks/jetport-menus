<?php

namespace App\Turbine\Livewire;

use App\Turbine\Livewire\Concerns\HandlesRestoreDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class BaseRestoreDialog extends Component
{
    use AuthorizesRequests;
    use HandlesRestoreDialogInteraction;

    public $listeners = [
        'confirmRestore',
        'closeConfirmRestore',
    ];
}
