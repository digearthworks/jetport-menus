<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\Concerns\HandlesDeleteDialogInteraction;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeleteUserDialog extends Component
{
    use AuthorizesRequests,
        HandlesDeleteDialogInteraction,
        InteractsWithBanner;

    public $confirmingDeleteUser = false;

    private $eloquentRepository = User::class;

    public $listeners = [
        'confirmDelete',
        'closeConfirmDelete',
    ];

    public function deleteUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $users->delete($this->model);

        $this->confirmingDelete = false;

        session()->flash('flash.banner', 'User Deleted!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.users.deleted');
    }

    public function render()
    {
        return view('admin.users.delete', [
            'user' => $this->model,
        ]);
    }
}
