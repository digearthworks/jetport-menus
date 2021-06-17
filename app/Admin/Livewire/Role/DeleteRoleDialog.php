<?php

namespace App\Admin\Livewire\Role;

use App\Auth\Actions\DeleteRoleAction;
use App\Auth\Models\Role;
use App\Http\Livewire\BaseDeleteDialog;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeleteRoleDialog extends BaseDeleteDialog
{
    use AuthorizesRequests;

    protected $eloquentRepository = Role::class;

    public function deleteRole(DeleteRoleAction $deleteRoleAction): void
    {
        $this->authorize('onlysuperadmincanddothis');

        $deleteRoleAction($this->model);

        $this->emit('roleDeleted');
        $this->confirmingDeleteRole = false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.roles.delete', [
            'role' => $this->model,
        ]);
    }
}
