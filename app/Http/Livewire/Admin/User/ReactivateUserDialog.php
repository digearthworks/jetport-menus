<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\BaseReactivateDialog;
use App\Models\User;
use App\Services\UserService;

class ReactivateUserDialog extends BaseReactivateDialog
{
    protected $eloquentRepository = User::class;

    public function reactivateUser(UserService $users)
    {
        $this->authorize('admin.access.users.reactivate');

        $users->mark($this->model, (int) 1);

        $this->emit('userReactivated');

        $this->confirmingReactivate = false;

        session()->flash('flash.banner', 'User Reactivated!');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('admin.users.reactivate', [
            'user' => $this->model,
        ]);
    }
}
