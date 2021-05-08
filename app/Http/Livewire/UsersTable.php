<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Support\Concerns\InteractsWithBanner;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class UsersTable.
 */
class UsersTable extends DataTableComponent
{

    use InteractsWithBanner;

    /**
     * @var
     */
    public $status;

    /**
     * @var array|string[]
     */
    public array $sortNames = [
        'email_verified_at' => 'Verified',
    ];

    /**
     * @var array|string[]
     */
    public array $filterNames = [
        'type' => 'User Type',
        'verified' => 'E-mail Verified',
    ];

    protected $listeners = [
        'userCreated' => 'userCreated',
        'userUpdated' => 'userUpdated',
        'userSessionsCleared' => 'userSessionsCleared',
        'userPasswordUpdated' => 'userPasswordUpdated',
        'userDeleted' => 'userDeleted',
        'userRestored' => 'userRestored',
        'userDeactivated' => 'userDeactivated',
        'userReactivated' => 'userReactivated',
        'refreshDatatable' => '$refresh',
    ];

    public function userCreated()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully saved!');
    }

    public function userUpdated()
    {
        $this->emit('refreshDatatable');
        $this->dangerBanner('Successfully saved!');
    }

    public function userSessionsCleared()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully Cleared Sessions!');
    }

    public function userPasswordUpdated()
    {
        $this->banner('Successfully updated password!');
    }

    public function userDeleted()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully Deleted User!');
        return redirect('/admin/auth/users/deleted');
    }

    public function userRestored()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully Restored User!');
        return redirect('/admin/auth/users');
    }

    public function userDeactivated()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully Deactivated User!');
        return redirect('/admin/auth/users/deactivated');
    }

    public function userReactivated()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully Deactivated User!');
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

    public function confirmClearSessions($userId)
    {
        $this->emit('confirmClearSessions', $userId);
    }

    public function confirmDeactivateUser($userId)
    {
        $this->emit('confirmDeactivateUser', $userId);
    }

    public function confirmReactivateUser($userId)
    {
        $this->emit('confirmReactivateUser', $userId);
    }

    public function openEditorForUserPassword($userId)
    {
        $this->emit('openEditorForUserPassword', $userId);
    }

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = User::with('roles')->withCount('roles');

        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive();
        }

        return $query
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term))
            ->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type))
            ->when($this->getFilter('active'), fn ($query, $active) => $query->where('active', $active === 'yes'))
            ->when($this->getFilter('verified'), fn ($query, $verified) => $verified === 'yes' ? $query->whereNotNull('email_verified_at') : $query->whereNull('email_verified_at'));
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            'type' => Filter::make('User Type')
                ->select([
                    '' => 'Any',
                    User::TYPE_ADMIN => 'Administrators',
                    User::TYPE_USER => 'Users',
                ]),
            'active' => Filter::make('Active')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
            'verified' => Filter::make('E-mail Verified')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
        ];
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->sortable(),
            Column::make(__('Name'))
                ->sortable(),
            Column::make(__('E-mail'), 'email')
                ->sortable(),
            Column::make(__('Verified'), 'email_verified_at')
                ->sortable(),
            Column::make(__('2FA'), 'two_factor_auth_count')
                ->sortable(),
            Column::make(__('Roles')),
            Column::make(__('Additional Permissions')),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'admin.users.includes.row';
    }

        /**
     * @return mixed
     */
    public function render()
    {

        return view('admin.users.livewire-tables.'. config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
            ]);
    }

}
