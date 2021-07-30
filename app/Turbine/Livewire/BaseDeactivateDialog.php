<?php

namespace App\Turbine\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Turbine\Livewire\Concerns\HandlesDeactivateDialogInteraction;

abstract class BaseDeactivateDialog extends Component
{
    use AuthorizesRequests;
    use HandlesDeactivateDialogInteraction;

    public $listeners = [
        'confirmDeactivate',
        'closeConfirmDeactivate',
    ];
}
