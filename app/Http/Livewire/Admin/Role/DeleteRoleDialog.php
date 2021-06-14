<?php

namespace App\Http\Livewire\Admin\Role;

use App\Http\Livewire\BaseDeleteDialog;
use App\Auth\Models\Role;
use App\Services\RoleService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeleteRoleDialog extends BaseDeleteDialog
{
    use AuthorizesRequests;

    protected $eloquentRepository = Role::class;

    public function deleteRole(RoleService $roles): void
    {
        $this->authorize('onlysuperadmincanddothis');

        $roles->destroy($this->model);
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
