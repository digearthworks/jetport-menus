<?php

namespace App\Turbine\Auth\Http\Livewire;

use App\Turbine\Auth\Actions\UpdateRoleAction;
use App\Turbine\Auth\Enums\UserTypeEnum;
use App\Turbine\Auth\Models\Role;
use App\Turbine\Livewire\BaseEditForm;
use Illuminate\Support\Facades\Auth;

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
        'menuItems' => [],
    ];

    protected $eloquentRepository = Role::class;

    public function editDialog($resourceId, $params = null)
    {
        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['type'] = $this->model->type;
        $this->state['name'] = $this->model->name;
        $this->state['permissions'] = array_map('strVal', $this->model->permissions()->pluck('id')->toArray());
        $this->state['menuItems'] = array_map('strVal', $this->model->menuItems()->pluck('id')->toArray());
        $this->dispatchBrowserEvent('showing-edit-role-modal');
    }

    public function updateRole(UpdateRoleAction $updateRoleAction)
    {
        if ($this->model->type->equals(UserTypeEnum::admin())) {
            $this->authorize('onlysuperadmincandothis');
        } else {
            $this->authorize('admin.access.users');
        }

        $this->resetErrorBag();

        // We will allow lower level admins to assign admin
        // menus and links, but we will not allow them to
        // change the type
        if (! Auth::user()->hasAllAccess()) {
            $this->state['type'] = $this->model->type;
        }

        $updateRoleAction($this->model, $this->state);

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
