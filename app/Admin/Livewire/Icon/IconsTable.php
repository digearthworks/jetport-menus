<?php

namespace App\Admin\Livewire\Icon;

use App\Http\Livewire\BaseDataTable;
use App\Icons\Models\Icon;
use App\Support\FontAwesome;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Schema;

/**
 * Class RolesTable.
 */
class IconsTable extends BaseDataTable
{
    public array $perPageAccepted = [4, 8, 100];

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Icon::query()->union($this->tempIconTable())
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function columns(): array
    {
        return [
            Column::make(__('Icon')),
            Column::make(__('Code')),
            Column::make(__('Meta')),
            Column::make(__('Menus')),
            Column::make(__('Actions')),
        ];
    }

    public function rowView(): string
    {
        return 'admin.icons.includes.row';
    }

    public function tempIconTable()
    {
        if (!Schema::hasTable('temp_icons')) {
            Schema::create('temp_icons', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable()->unique();
                $table->string('meta')->nullable();
                $table->string('source')->nullable();
                $table->string('class')->nullable();
                $table->string('version')->nullable();
                $table->text('html')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unique(['source','class','version'], 'source_class_version');
            });

            $fontAwesomeIcons = FontAwesome::all();

            foreach ($fontAwesomeIcons as $icon) {
                DB::table('temp_icons')->insert([
                    'class' => $icon->class,
                    'source' => $icon->source,
                    'version' => $icon->version,
                ]);
            }
        }

        return DB::table('temp_icons')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('class', 'like', '%'. $term . '%'));
    }
}
