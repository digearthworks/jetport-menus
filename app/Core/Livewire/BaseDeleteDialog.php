<?php

namespace App\Core\Livewire;

use App\Http\Livewire\Concerns\HandlesDeleteDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class BaseDeleteDialog extends Component
{
    use AuthorizesRequests,
        HandlesDeleteDialogInteraction;

    public $listeners = [
        'confirmDelete',
        'closeConfirmDelete',
    ];
}
