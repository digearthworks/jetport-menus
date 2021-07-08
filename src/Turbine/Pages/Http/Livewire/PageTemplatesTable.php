<?php

namespace Turbine\Pages\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Turbine\Livewire\BaseDataTable;
use Turbine\Pages\Models\PageTemplate;

/**
 * Class RolesTable.
 */
class PageTemplatesTable extends BaseDataTable
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = PageTemplate::query();

        return $query->ordered()->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name')),
            Column::make(__('Author')),
            Column::make(__('Updated At')),
            Column::make(__('Created At')),
            Column::make(__('Actions')),
        ];
    }

    public function rowView(): string
    {
        return 'admin.pages.template-row';
    }
}
