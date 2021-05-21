<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Concerns\HandlesReactivateDialogInteraction;
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
