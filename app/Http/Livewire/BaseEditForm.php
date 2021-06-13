<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Concerns\HandlesEditDialogInteraction;
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
