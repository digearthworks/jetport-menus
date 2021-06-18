<?php

namespace App\Core\Livewire;

use App\Core\Livewire\Concerns\HandlesDeactivateDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

abstract class BaseDeactivateDialog extends Component
{
    use AuthorizesRequests,
        HandlesDeactivateDialogInteraction;

    public $listeners = [
        'confirmDeactivate',
        'closeConfirmDeactivate',
    ];
}
