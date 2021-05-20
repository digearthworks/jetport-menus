<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Concerns\HandlesCreateDialogInteraction;
use App\Http\Livewire\Concerns\InteractsWithDialogs;
use Livewire\Component;

class CreateUserButton extends Component
{
    use InteractsWithDialogs,
        HandlesCreateDialogInteraction;

    public function render()
    {
        return view('admin.users.includes.partials.create-user-button');
    }
}
