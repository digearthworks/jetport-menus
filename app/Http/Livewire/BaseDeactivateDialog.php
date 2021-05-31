<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Concerns\HandlesDeactivateDialogInteraction;
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
