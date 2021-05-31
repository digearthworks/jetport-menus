<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Concerns\HandlesRestoreDialogInteraction;
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
