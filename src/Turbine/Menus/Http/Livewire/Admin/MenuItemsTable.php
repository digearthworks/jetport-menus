<?php

namespace Turbine\Menus\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Turbine\Livewire\BaseDataTable;
use Turbine\Menus\Models\MenuItem;

class MenuItemsTable extends BaseDataTable
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = MenuItem::ordered()->withCount('roles')
            ->with('icon', 'children', 'menu', 'roles', 'users')
            ->withCount('users')
            ->withCount('children');

        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive()->where('parent_id', null)->orderBy('menu_id')->ordered();
        }

        return $query->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make(__('Group'), 'group')
                ->sortable(),
            Column::make(__('Name'), 'name')
                ->sortable(),
            Column::make(__('Icon / link'), 'uri_with_art'),
            Column::make(__('Roles Count')),
            Column::make(__('Users Count'), 'users_count')
                ->sortable(),
            Column::make(__('Actions')),
            Column::make(__('Menu Items'), 'children_count'),
        ];
    }

    public function rowView(): string
    {
        return 'admin.menus.row';
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('admin.users.livewire-tables.' . config('livewire-tables.theme') . '.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
            ]);
    }
}
