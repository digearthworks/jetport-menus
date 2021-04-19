<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $userId;

    public $editingUser;

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
        'permisions' => [],
    ];


    public function mount($userId = null)
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
        $this->updateUserForm['menus'] = $user->menus()->pluck('id');
        $this->updateUserForm['roles'] = $user->roles()->pluck('id');
    }

    public function render()
    {
        return view('admin.user.edit', [
            'user' => $this->getUser($this->userId),
            'type' => 'user',
        ]);
    }

    public function getUser($userId = null)
    {
        return User::query()->find($userId);
    }
}
