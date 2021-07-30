<?php

namespace App\Turbine\Livewire;

use App\Turbine\Livewire\Concerns\HandlesDeleteDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class BaseDeleteDialog extends Component
{
    use AuthorizesRequests;
    use HandlesDeleteDialogInteraction;

    public $listeners = [
        'confirmDelete',
        'closeConfirmDelete',
    ];
}
