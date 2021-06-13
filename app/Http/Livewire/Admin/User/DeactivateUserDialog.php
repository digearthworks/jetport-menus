<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\BaseDeactivateDialog;
use App\Models\User;
use App\Services\UserService;

class DeactivateUserDialog extends BaseDeactivateDialog
{
    protected $eloquentRepository = User::class;

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.deactivate', [
            'user' => $this->model,
        ]);
    }
}
