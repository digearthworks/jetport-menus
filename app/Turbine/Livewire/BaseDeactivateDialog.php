<?php

namespace App\Turbine\Livewire;

use App\Turbine\Livewire\Concerns\HandlesDeactivateDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

abstract class BaseDeactivateDialog extends Component
{
    use AuthorizesRequests;
    use HandlesDeactivateDialogInteraction;

    public $listeners = [
        'confirmDeactivate',
        'closeConfirmDeactivate',
    ];
}
