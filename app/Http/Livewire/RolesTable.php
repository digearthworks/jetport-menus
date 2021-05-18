<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Support\Concerns\InteractsWithBanner;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class RolesTable extends DataTableComponent
{
    use InteractsWithBanner;

    protected $listeners = [
        'roleCreated' => 'roleCreated',
        'roleUpdated' => 'roleUpdated',
        'roleDeleted' => 'roleDeleted',
        // 'roleRestored' => 'roleRestored',
        // 'roleDeactivated' => 'roleDeactivated',
        // 'roleReactivated' => 'roleReactivated',
        'refreshDatatable' => '$refresh',
    ];

    public function roleUpdated()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully saved changes!');
    }

    public function roleCreated()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully created role!');
    }

    public function roleDeleted()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully deleted role!');
    }

    public function openEditorForRole($roleId)
    {
        $this->emit('openEditorForRole', $roleId);
    }

    public function confirmDeleteRole($roleId)
    {
        $this->emit('confirmDeleteRole', $roleId);
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Role::with('permissions:id,name,description')
            ->withCount('users')
            ->with('menus')
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
        return 'admin.roles.includes.row';
    }
}
