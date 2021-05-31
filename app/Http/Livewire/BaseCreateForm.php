<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Concerns\HandlesCreateDialogInteraction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

abstract class BaseCreateForm extends Component
{
    use AuthorizesRequests,
        HandlesCreateDialogInteraction;

    public $listeners = [
        'createDialog',
        'closeCreateDialog',
    ];
}
