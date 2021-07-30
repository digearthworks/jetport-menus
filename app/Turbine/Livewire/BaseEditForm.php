<?php

namespace App\Turbine\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Turbine\Livewire\Concerns\HandlesEditDialogInteraction;

class BaseEditForm extends Component
{
    use AuthorizesRequests;
    use HandlesEditDialogInteraction;

    public $listeners = [
        'editDialog',
        'closeEditDialog',
    ];
}
