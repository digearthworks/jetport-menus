<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Mediconesystems\LivewireDatatables\Column;

class UsersTable extends BaseTable
{
    public $model = User::class;

    /**
     * Indicates if the application is confirming if a user should be restored.
     *
     * @var bool
     */
    public $confirmingUserRestore = false;

    /**
     * Indicates if the application is confirming if a user should be restored.
     *
     * @var bool
     */
    public $confirmingPermanentDelete = false;

    /**
     * Indicates if a user is being edited.
     *
     * @var bool
     */
    public $editingUser = false;

    /**
     * Indicates if the user type is set to admin.
     *
     * @var bool
     */
    public $userType = 'user';

    /**
     * The ID of the user being edited.
     *
     * @var string
     */
    public $userIdBeingEdited;

    /**
     * The ID of the user being restored.
     *
     * @var string
     */
    public $userIdBeingRestored;

    /**
     * The ID of the user being Permanently Deleted.
     *
     * @var string
     */
    public $userIdBeingPermanentlyDeleted;

    /**
     * The update form state.
     *
     * @var array
     */
    public $updateUserForm = [
        'type' => '',
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

    /**
     * The create form state.
     *
     * @var array
     */
    public $createUserForm = [
        'type' => '',
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

    /**
     * Confirm that the given user should be restored.
     */
    public function confirmUserRestore($userIdBeingRestored)
    {
        $this->confirmingUserRestore = true;

        $this->userIdBeingRestored = $userIdBeingRestored;
    }

    /**
     * Confirm that the given user should be restored.
     */
    public function setUserType($userType)
    {
        dd($userType);
        $this->userType = $userType;
    }

    /**
     * Confirm that the given user should be restored.
     */
    public function editUser(UserService $users, $userIdBeingEdited)
    {
        $this->editingUser = true;

        $this->userIdBeingEdited = $userIdBeingEdited;

        $user = $users->getById($userIdBeingEdited);

        $this->updateUserForm['type'] = $user->type;
        $this->userType = $user->type;
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

    /**
     * Confirm that the given user should be restored.
     */
    public function confirmPermanentDelete($userIdBeingPermanentlyDeleted)
    {
        $this->confirmingPermanentDelete = true;

        $this->$userIdBeingPermanentlyDeleted = $userIdBeingPermanentlyDeleted;
    }

    public function columns()
    {
        return [
            Column::name('id')
                ->hide(),

            Column::name('type')
                ->label(__('Type'))
                ->defaultSort('asc')
                ->searchable()
                // ->filterable()
                ->view('tables.user.type'),

            Column::name('name')
                // ->filterable()
                ->searchable(),

            Column::callback(['email'], fn ($email) => $this->mailto($email))
                ->label(__('E-mail'))
                // ->filterable()
                ->searchable(),

            Column::name('email_verified_at')
                ->label(__('Verified'))
                ->searchable()
                // ->filterable()
                ->view('tables.user.verified'),

            Column::name('two_factor_secret')
                ->label(__('2FA'))
                ->searchable()
                // ->filterable()
                ->view('tables.user.2fa'),

            Column::name('roles.name')
                ->label(__('Role')),

            Column::callback('id', function ($id) {
                return view('tables.user.actions', [
                    // 'menus' => Menu::query()->where('menu_id', null)->with('children')->get(),
                    'user' => User::query()->find($id),
                    // 'roles' => Role::with('permissions')->get(),
                    'userType' => $this->userType,
                ]);
            })->label(__('Actions'))
        ];
    }
}
