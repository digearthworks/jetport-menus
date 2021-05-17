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

    public $status;

    protected $listeners = [
        'created' => 'created',
        'itemUpdated' => 'itemUpdated',
        'deleted' => 'deleted',
        'restored' => 'restored',
        // 'menuDeactivated' => 'menuDeactivated',
        // 'menuReactivated' => 'menuReactivated',
        'refreshDatatable' => '$refresh',
    ];

    public function itemUpdated()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully saved changes!');
    }

    public function restored()
    {
        $this->emit('refreshDatatable');
        return redirect('/admin/auth/menus')
            ->with('flash.banner', 'Menu Restored!.')
            ->with('flash.bannerStyle', 'success');
    }

    public function created()
    {
        $this->emit('refreshDatatable');
        $this->banner('Successfully created menu!');
    }

    public function openEditor($id)
    {
        $this->emit('openEditor', $id);
    }

    public function confirmDelete($id)
    {
        $this->emit('confirmDelete', $id);
    }

    public function confirmRestore($id)
    {
        $this->emit('confirmRestore', $id);
    }

    public function confirmReactivate($id)
    {
        $this->emit('confirmReactivate', $id);
    }

    public function confirmDeactivate($id)
    {
        $this->emit('confirmDeactivate', $id);
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Menu::withCount('roles');

        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive();
        }

        return $query->with('icon')
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
            Column::make(__('Name'), 'name')
                ->sortable(),
            Column::make(__('Nav'), 'link_with_art'),
            Column::make(__('Roles Count')),
            Column::make(__('Users Count'), 'users_count')
                ->sortable(),
            Column::make(__('Actions')),
            Column::make(__('Menu Items'), 'children_count'),
        ];
    }

    public function rowView(): string
    {
        return 'admin.menus.includes.row';
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
