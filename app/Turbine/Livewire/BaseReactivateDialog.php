<?php

namespace App\Turbine\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Turbine\Livewire\Concerns\HandlesReactivateDialogInteraction;

abstract class BaseReactivateDialog extends Component
{
    use AuthorizesRequests;
    use HandlesReactivateDialogInteraction;

    public $listeners = [
        'confirmReactivate',
        'closeConfirmReactivate',
    ];
}
