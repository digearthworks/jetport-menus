<?php

namespace App\Http\Livewire;

use App\Services\RoleService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CreateRole extends Component
{
    use AuthorizesRequests,
        InteractsWithBanner;

    public $roleId;

    public $creatingRole = false;

    /**
     * The create form state.
     *
     * @var array
     */
    public $createRoleForm = [
        'type' => 'user',
        'name' => '',
        'permissions' => [],
    ];

    public $listeners = ['openCreatorForRole'];

    public function openCreatorForRole()
    {
        $this->authorize('onlysuperadmincandothis');

        $this->creatingRole = true;
    }

    public function createRole(RoleService $roles)
    {
        $this->resetErrorBag();

        $validator = Validator::make($this->createRoleForm, [
            'type' => ['string'],
            'name' => ['required', Rule::unique($roles->getTableName())],
            'permissions' => ['array'],
        ]);
        $roles->store($validator->validateWithBag('createdRoleForm'));
        $this->emit('roleCreated');
        $this->emit('closeCreateDialog');
        $this->creatingRole = false;
    }

    public function closeCreateDialog()
    {
        $this->creatingRole = false;
        $this->emit('closeCreateDialogForRole');
    }

    public function render()
    {
        return view('admin.roles.create');
    }
}
