<?php

namespace App\Core\Livewire;

use App\Core\Livewire\Concerns\HandlesReactivateDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

abstract class BaseReactivateDialog extends Component
{
    use AuthorizesRequests,
        HandlesReactivateDialogInteraction;

    public $listeners = [
        'confirmReactivate',
        'closeConfirmReactivate',
    ];
}
