<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Support\Concerns\InteractsWithBanner;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MenusTable extends DataTableComponent
{
    use InteractsWithBanner;

    protected $listeners = [
        'created' => 'created',
        'updated' => 'updated',
        'deleted' => 'deleted',
        // 'menuRestored' => 'menuRestored',
        // 'menuDeactivated' => 'menuDeactivated',
        // 'menuReactivated' => 'menuReactivated',
        'refreshDatatable' => '$refresh',
    ];

    public function updated()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully saved changes!');
    }

    public function created()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully created menu!');
    }

    public function deleted()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully deleted menu!');
    }

    public function openEditor($id)
    {
        $this->emit('openEditor', $id);
    }

    public function confirmDelete($id)
    {
        $this->emit('confirmDelete', $id);
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Menu::withCount('roles')
            ->with('icon')
            ->withCount('users')
            ->withCount('children')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make(__('Menu'), 'parent.label'),
            Column::make(__('Group'), 'group')
                ->sortable(),
            Column::make(__('Active'), 'active')
                ->sortable(),
            Column::make(__('Nav'), 'link_with_art'),
            Column::make(__('Menu Items'), 'children_count'),
            Column::make(__('Number of Roles')),
            Column::make(__('Number of Users'), 'users_count')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    public function rowView(): string
    {
        return 'admin.menus.includes.row';
    }
}
