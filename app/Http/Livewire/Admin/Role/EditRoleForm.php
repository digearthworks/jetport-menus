<?php

namespace App\Http\Livewire\Admin\Role;

use App\Http\Livewire\Admin\BaseEditForm;
use App\Models\Role;
use App\Services\RoleService;
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
        $this->authorize('onlysuperadmincandothis');

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
        $this->authorize('is_admin');

        $this->resetErrorBag();

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
