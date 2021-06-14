<?php

namespace App\Http\Livewire\Admin\Role;

use App\Auth\Models\Role;
use App\Auth\Models\User;
use App\Http\Livewire\BaseEditForm;
use App\Services\RoleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditRoleForm extends BaseEditForm
{

    /**
     * The update form state.
     *
     * @var array
     */
    public $state = [
        'type' => 'user',
        'name' => '',
        'permissions' => [],
        'menus' => [],
    ];

    protected $eloquentRepository = Role::class;

    public function editDialog($resourceId, $params = null)
    {
        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['type'] = $this->model->type;
        $this->state['name'] = $this->model->name;
        $this->state['permissions'] = array_map('strVal', $this->model->permissions()->pluck('id')->toArray());
        $this->state['menus'] = array_map('strVal', $this->model->menus()->pluck('id')->toArray());
        $this->dispatchBrowserEvent('showing-edit-role-modal');
    }

    public function updateRole(RoleService $roles)
    {
        if ($this->model->type == User::TYPE_ADMIN) {
            $this->authorize('onlysuperadmincandothis');
        } else {
            $this->authorize('admin.access.users');
        }

        $this->resetErrorBag();

        // We will allow lower level admins to assign admin
        // menus and links, but we will not allow them to
        // change the type
        if (!Auth::user()->hasAllAccess()) {
            $this->state['type'] = $this->model->type;
        }

        Validator::make($this->state, [
            'type' => ['string'],
            'name' => ['required', Rule::unique($roles->getTableName())->ignore($this->modelId)],
            'permissions' => ['array'],
            'menus' => ['array'],
        ])->validateWithBag('updateRoleForm');

        $roles->update($this->model, $this->state);
        $this->emit('refreshWithSuccess', 'Role Updated!');
        $this->editingResource = false;
    }

    public function render()
    {
        return view('admin.roles.edit', [
            'role' => $this->model,
        ]);
    }
}
