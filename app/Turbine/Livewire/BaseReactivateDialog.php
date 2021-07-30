<?php

namespace App\Turbine\Livewire;

use App\Turbine\Livewire\Concerns\HandlesReactivateDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

abstract class BaseReactivateDialog extends Component
{
    use AuthorizesRequests;
    use HandlesReactivateDialogInteraction;

    public $listeners = [
        'confirmReactivate',
        'closeConfirmReactivate',
    ];
}
