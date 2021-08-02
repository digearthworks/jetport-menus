<?php

namespace App\Turbine\Livewire;

use App\Turbine\Livewire\Concerns\HandlesEditDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class BaseEditForm extends Component
{
    use AuthorizesRequests;
    use HandlesEditDialogInteraction;

    public $listeners = [
        'editDialog',
        'closeEditDialog',
    ];
}
