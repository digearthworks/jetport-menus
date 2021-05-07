<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CreatesUser extends Component
{
    use GetsUser,
        InteractsWithBanner;

    public $userId;

    public $creatingUser = false;

    /**
     * The update form state.
     *
     * @var array
     */
    public $createUserForm = [
        'type' => 'user',
        'name' => '',
        'first_name' => '',
        'last_name' => '',
        'middle_initial' => '',
        'email' => '',
        'password' => '',
        'active' => '1',
        'menus' => [],
        'roles' => [],
        'permissions' => [],
    ];

    public function openCreateDialog()
    {
        $this->creatingUser = true;
    }

    public function createUser(UserService $users)
    {
        // dd($this->createUserForm);
        $users->store($this->createUserForm);
        $this->emit('userCreated');
        $this->creatingUser = false;
    }

    public function render()
    {
        return view('admin.user.create');
    }
}
