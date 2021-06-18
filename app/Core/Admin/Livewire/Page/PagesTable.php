<?php

namespace App\Core\Admin\Livewire\Page;

use App\Core\Livewire\BaseDataTable;
use App\Core\Pages\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class PagesTable extends BaseDataTable
{

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Page::query();

        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive();
        }

        return $query->ordered()->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name/Slug')),
            Column::make(__('Author')),
            Column::make(__('Updated At')),
            Column::make(__('Created At')),
            Column::make(__('Actions')),
        ];
    }

    public function rowView(): string
    {
        return 'admin.pages.row';
    }
}
