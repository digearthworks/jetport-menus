<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Concerns\HandlesDeactivateDialogInteraction;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeactivateUserDialog extends Component
{
    use AuthorizesRequests,
        HandlesDeactivateDialogInteraction,
        InteractsWithBanner;

    private $eloquentRepository = User::class;

    public $listeners = [
        'confirmDeactivate',
        'closeConfirmDeactivate',
    ];

    public function deactivateUser(UserService $users)
    {
        $this->authorize('admin.access.users.deactivate');

        $users->mark($this->model, (int) 0);

        $this->emit('userDeactivated');

        $this->confirmingDeactivateUser = false;

        session()->flash('flash.banner', 'User Deactivated!');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.users.deactivated');
    }

    public function render()
    {
        return view('admin.users.deactivate', [
            'user' => $this->model,
        ]);
    }
}
