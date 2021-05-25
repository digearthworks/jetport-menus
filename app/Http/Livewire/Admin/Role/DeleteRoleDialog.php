<?php

namespace App\Http\Livewire\Admin\Role;

use App\Http\Livewire\Admin\BaseDeleteDialog;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeleteRoleDialog extends BaseDeleteDialog
{
    use AuthorizesRequests;

    protected $eloquentRepository = Role::class;

    public function deleteRole(RoleService $roles)
    {
        $this->authorize('onlysuperadmincanddothis');

        $roles->destroy($this->model);
        $this->emit('roleDeleted');
        $this->confirmingDeleteRole = false;
    }

    public function render()
    {
        return view('admin.roles.delete', [
            'role' => $this->model,
        ]);
    }
}
