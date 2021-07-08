<?php

namespace Turbine\Auth\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Turbine\Auth\Actions\DeleteRoleAction;
use Turbine\Auth\Models\Role;
use Turbine\Livewire\BaseDeleteDialog;

class DeleteRoleDialog extends BaseDeleteDialog
{
    use AuthorizesRequests;

    protected $eloquentRepository = Role::class;

    public function deleteRole(DeleteRoleAction $deleteRoleAction): void
    {
        $this->authorize('onlysuperadmincanddothis');

        $deleteRoleAction($this->model);

        $this->emit('refreshWithSuccess', 'Role Deleted');
        $this->confirmingDelete = false;
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
