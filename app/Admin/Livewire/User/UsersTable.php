<?php

namespace App\Admin\Livewire\User;

use App\Auth\Models\User;
use App\Http\Livewire\BaseDataTable;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class UsersTable.
 */
class UsersTable extends BaseDataTable
{

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
        $query = User::with('roles')->with('menus')->withCount('roles');

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
            // Column::make(__('Verified'), 'email_verified_at')
            //     ->sortable(),
            Column::make(__('Last Login'), 'last_login_at')
                ->sortable(),
            Column::make(__('Roles')),
            // Column::make(__('Added Permissions')),
            Column::make(__('menus')),
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
