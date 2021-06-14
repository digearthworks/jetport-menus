<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseDataTable;
use App\Pages\Models\SitePage;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class SitePagesTable extends BaseDataTable
{

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = SitePage::query();

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
        return 'admin.site.pages.includes.row';
    }
}
