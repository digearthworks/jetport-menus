<?php

namespace App\Core\Livewire;

use App\Core\Livewire\Concerns\HandlesRestoreDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class BaseRestoreDialog extends Component
{
    use AuthorizesRequests,
        HandlesRestoreDialogInteraction;

    public $listeners = [
        'confirmRestore',
        'closeConfirmRestore',
    ];
}
