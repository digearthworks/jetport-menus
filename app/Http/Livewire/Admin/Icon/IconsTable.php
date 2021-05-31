<?php

namespace App\Http\Livewire\Admin\Icon;

use App\Http\Livewire\BaseDataTable;
use App\Models\Icon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class RolesTable.
 */
class IconsTable extends BaseDataTable
{

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Icon::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make(__('Icon')),
        ];
    }

    public function rowView(): string
    {
        return 'admin.icons.includes.row';
    }
}
