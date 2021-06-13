<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Livewire\BaseRestoreDialog;
use App\Models\User;
use App\Services\UserService;

class RestoreUserDialog extends BaseRestoreDialog
{
    protected $eloquentRepository = User::class;

    public function restoreUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $users->restore($this->model, true);

        $this->confirmingRestore = false;

        session()->flash('flash.banner', 'User Restored!');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.users');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.users.restore', [
            'user' => $this->model,
        ]);
    }
}
