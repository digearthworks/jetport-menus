<?php

namespace Turbine\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Turbine\Livewire\Concerns\HandlesDeleteDialogInteraction;

class BaseDeleteDialog extends Component
{
    use AuthorizesRequests;
    use HandlesDeleteDialogInteraction;

    public $listeners = [
        'confirmDelete',
        'closeConfirmDelete',
    ];
}
