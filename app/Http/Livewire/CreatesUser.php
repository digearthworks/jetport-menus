<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Illuminate\Support\Facades\Validator;
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

    public $listeners = ['openCreateDialog'];

    public function openCreateDialog()
    {
        $this->creatingUser = true;
        $this->dispatchBrowserEvent('showing-create-user-modal');
    }

    public function closeCreateDialog()
    {
        $this->creatingUser = false;
        $this->emit('closeCreateDialog');
    }

    public function createUser(UserService $users)
    {
        $this->resetErrorBag();

        $validator = Validator::make($this->createUserForm, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $users->store($validator->validateWithBag('creatUserForm'));
        $this->emit('closeCreateDialog');
        $this->emit('userCreated');
        $this->creatingUser = false;
    }

    public function render()
    {
        return view('admin.user.create');
    }
}
