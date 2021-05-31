<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\BaseDeleteDialog;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeleteUserDialog extends BaseDeleteDialog
{
    use AuthorizesRequests;

    protected $eloquentRepository = User::class;

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
