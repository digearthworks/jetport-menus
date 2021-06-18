<?php

namespace App\Core\Admin\Livewire\User;

use App\Core\Auth\Actions\RestoreUserAction;
use App\Core\Auth\Models\User;
use App\Core\Livewire\BaseRestoreDialog;

class RestoreUserDialog extends BaseRestoreDialog
{
    protected $eloquentRepository = User::class;

    public function restoreUser(RestoreUserAction $restoreUserAction)
    {
        $this->authorize('admin.access.users');

        $restoreUserAction($this->model, true);

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
