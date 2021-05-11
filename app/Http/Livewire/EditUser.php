<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class EditUser extends Component
{
    use AuthorizesRequests,
        GetsUser,
        InteractsWithBanner;

    public $userId;

    public $editingUser = false;

    /**
     * The update form state.
     *
     * @var array
     */
    public $updateUserForm = [
        'type' => 'user',
        'name' => '',
        'first_name' => '',
        'last_name' => '',
        'middle_initial' => '',
        'email' => '',
        'password' => '',
        'active' => '',
        'menus' => [],
        'roles' => [],
        'permissions' => [],
    ];

    public $listeners = ['openEditorForUser'];

    public function openEditorForUser($userId)
    {
        $this->editingUser = true;
        $this->userId = $userId;
        $user  = $this->getUser($userId);
        $this->updateUserForm['type'] = $user->type;
        $this->updateUserForm['name'] = $user->name;
        $this->updateUserForm['first_name'] = $user->first_name;
        $this->updateUserForm['last_name'] = $user->last_name;
        $this->updateUserForm['middle_initial'] = $user->middle_initail;
        $this->updateUserForm['email'] = $user->email;
        $this->updateUserForm['password'] = $user->password;
        $this->updateUserForm['active'] = $user->active;
        $this->updateUserForm['menus'] = array_map('strVal', $user->menus()->pluck('id')->toArray());
        $this->updateUserForm['roles'] = array_map('strVal', $user->roles()->pluck('id')->toArray());
        $this->updateUserForm['permissions'] = array_map('strVal', $user->getDirectPermissions()->pluck('id')->toArray());
        $this->dispatchBrowserEvent('showing-edit-user-modal');
    }

    public function updateUser(UserService $users)
    {
        $this->authorize('admin.access.users');

        $this->resetErrorBag();

        Validator::make($this->updateUserForm, [
            'type' => ['string'],
            'name' => ['required'],
            'email' => ['required','email', 'max:255', Rule::unique($users->getTableName())->ignore($this->userId)],
            'active' => ['integer'],
            'roles' => ['array'],
            'permissions' => ['array'],
            'menus' => ['array'],
            'send_confirmation_email' => ['integer'],
            'email_verified' => ['integer'],
        ])->validateWithBag('updatedUserForm');

        $users->update($this->getUser($this->userId), $this->updateUserForm);
        $this->emit('userUpdated');
        $this->editingUser = false;
    }

    public function render()
    {
        return view('admin.users.edit', [
            'user' => $this->getUser($this->userId),
        ]);
    }
}
