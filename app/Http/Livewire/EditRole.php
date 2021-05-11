<?php

namespace App\Http\Livewire;

use App\Services\RoleService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class EditRole extends Component
{
    use AuthorizesRequests,
        GetsRole,
        InteractsWithBanner;

    public $roleId;

    public $editingRole = false;

    /**
     * The update form state.
     *
     * @var array
     */
    public $updateRoleForm = [
        'type' => 'user',
        'name' => '',
        'permissions' => [],
    ];

    public $listeners = ['openEditorForRole'];

    public function openEditorForRole($roleId)
    {
        $this->authorize('onlysuperadmincandothis');

        $this->editingRole = true;
        $this->roleId = $roleId;
        $role  = $this->getRole($roleId);
        $this->updateRoleForm['type'] = $role->type;
        $this->updateRoleForm['name'] = $role->name;
        $this->updateRoleForm['permissions'] = array_map('strVal', $role->permissions()->pluck('id')->toArray());
        $this->dispatchBrowserEvent('showing-edit-role-modal');
    }

    public function updateRole(RoleService $roles)
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();

        Validator::make($this->updateRoleForm, [
            'type' => ['string'],
            'name' => ['required', Rule::unique($roles->getTableName())->ignore($this->roleId)],
            'permissions' => ['array'],
        ])->validateWithBag('updateRoleForm');

        $roles->update($this->getRole($this->roleId), $this->updateRoleForm);
        $this->emit('roleUpdated');
        $this->editingRole = false;
    }

    public function render()
    {
        return view('admin.roles.edit', [
            'role' => $this->getRole($this->roleId),
        ]);
    }
}
