<?php

namespace App\Turbine\Auth\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\Contracts\DeletesUsers;
use App\Turbine\Auth\Models\User;
use App\Turbine\Livewire\BaseDeleteDialog;

class DeleteUserDialog extends BaseDeleteDialog
{
    use AuthorizesRequests;

    protected $eloquentRepository = User::class;

    public function deleteUser(DeletesUsers $deleteUser)
    {
        $this->authorize('admin.access.users');

        if ($this->model->id === auth()->id()) {
            abort(403, 'You cannot delete yourself here. Please delete your account from your user profile.');
        }

        $deleteUser->delete($this->model);

        $this->confirmingDelete = false;

        $this->emit('refreshWithSuccess', 'User Deleted');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.delete', [
            'user' => $this->model,
        ]);
    }
}
