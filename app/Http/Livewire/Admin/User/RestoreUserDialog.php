<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Concerns\HandlesRestoreDialogInteraction;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class RestoreUserDialog extends Component
{
    use AuthorizesRequests,
        HandlesRestoreDialogInteraction,
        InteractsWithBanner;

    public $listeners = [
        'confirmRestore',
        'closeConfirmRestore',
    ];

    private $eloquentRepository = User::class;

    public function restoreUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $users->restore($this->model, true);

        $this->confirmingRestore = false;

        session()->flash('flash.banner', 'User Restored!');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('admin.users.restore', [
            'user' => $this->model,
        ]);
    }
}
