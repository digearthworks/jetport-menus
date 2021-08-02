<?php

namespace App\Turbine\Auth\Http\Livewire;

use App\Turbine\Auth\Models\Role;
use App\Turbine\Livewire\BaseDataTable;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class RolesTable extends BaseDataTable
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Role::with('permissions:id,name,description')
            ->withCount('users')
            ->with('menuItems')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->sortable(),
            Column::make(__('Name'))
                ->sortable(),
            Column::make(__('Permissions')),
            Column::make(__('Number of Users'), 'users_count')
                ->sortable(),
            Column::make(__('Menus')),
            Column::make(__('Actions')),
        ];
    }

    public function rowView(): string
    {
        return 'admin.roles.row';
    }
}
