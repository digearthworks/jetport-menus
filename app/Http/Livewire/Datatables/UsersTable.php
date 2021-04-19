<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use App\Support\Concerns\InteractsWithBanner;
use Mediconesystems\LivewireDatatables\Column;

class UsersTable extends BaseTable
{
    use InteractsWithBanner;

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

    protected $listeners = ['userUpdated', 'refreshLivewireDatatable'];

    public function userUpdated()
    {
        $this->emit('refreshLivewireDatatable');
        $this->banner('Successfully saved!');
    }

    public function openEditorForUser($userId)
    {
        $this->emit('openEditorForUser', $userId);
    }

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
