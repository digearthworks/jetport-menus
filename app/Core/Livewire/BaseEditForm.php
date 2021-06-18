<?php

namespace App\Core\Livewire;

use App\Core\Livewire\Concerns\HandlesEditDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class BaseEditForm extends Component
{
    use AuthorizesRequests,
        HandlesEditDialogInteraction;

    public $listeners = [
        'editDialog',
        'closeEditDialog',
    ];
}
