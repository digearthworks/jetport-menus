<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Support\Concerns\InteractsWithBanner;
use Mediconesystems\LivewireDatatables\Column;

class UsersTable extends BaseTable
{
    use InteractsWithBanner;

    public $status;

    public $overflowXWrap = false;

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
     * The ID of the user being Deleted.
     *
     * @var string
     */
    public $userIdBeingDeleted;

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

    protected $listeners = ['userUpdated', 'userDeleted', 'userRestored', 'refreshLivewireDatatable'];

    public function userUpdated()
    {
        $this->emit('refreshLivewireDatatable');
        $this->banner('Successfully saved!');
    }

    public function userDeleted()
    {
        $this->emit('refreshLivewireDatatable');
        $this->banner('Successfully Deleted User!');
        return redirect('/admin/auth/users/deleted');
    }

    public function userRestored()
    {
        $this->emit('refreshLivewireDatatable');
        $this->banner('Successfully Restored User!');
        return redirect('/admin/auth/users');
    }

    public function openEditorForUser($userId)
    {
        $this->emit('openEditorForUser', $userId);
    }

    public function confirmDeleteUser($userId)
    {
        $this->emit('confirmDeleteUser', $userId);
    }

    public function confirmRestoreUser($userId)
    {
        $this->emit('confirmRestoreUser', $userId);
    }

    public function confirmDeactivateUser($userId)
    {
        $this->emit('confirmDeactivateUser', $userId);
    }

    public function changePasswordForUser($userId)
    {
        $this->emit('changePasswordForUser', $userId);
    }

    /**
     * Confirm that the given user should be restored.
     */
    public function confirmPermanentDelete($userIdBeingPermanentlyDeleted)
    {
        $this->confirmingPermanentDelete = true;

        $this->$userIdBeingPermanentlyDeleted = $userIdBeingPermanentlyDeleted;
    }


    public function builder()
    {
        $query = User::with('roles');

        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive();
        }
        return $query;
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

            Column::callback(['email_verified_at', 'id'], function ($emailVerifiedAt, $id) {
                return view('tables.user.verified', [
                    'user' => $this->builder()->where('id', $id)->first(),
                    'value' => $emailVerifiedAt,
                ]);
            })->label(__('Verified'))
                ->searchable(),

            Column::callback(['two_factor_secret', 'id'], function ($twoFactorAuth, $id) {
                return view('tables.user.2fa', [
                    'user' => $this->builder()->where('id', $id)->first(),
                ]);
            })->label(__('2FA')),

            Column::name('roles.name')
                ->label(__('Role')),

            Column::callback('id', function ($id) {
                return view('tables.user.actions', [
                    'user' => $this->builder()->where('id', $id)->first(),
                    // 'roles' => Role::with('permissions')->get(),
                    'userType' => $this->userType,
                ]);
            })->label(__('Actions'))
        ];
    }
}
