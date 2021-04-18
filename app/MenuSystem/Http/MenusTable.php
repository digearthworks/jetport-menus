<?php

namespace App\MenuSystem\Http;

use App\MenuSystem\Menu;
use Illuminate\Database\Eloquent\Builder;
//use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MenusTable extends BaseTable
{
    //use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'id';

    /**
     * @var string
     */
    public $group;

    /**
     * @var bool
     */
    public $withChildren;

    /**
     * @var bool
     */
    public $withManualStriping;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table',
    ];

    public function mount($uniqueSeed = '', $group = 'all', $withChildren = false, $groupMeta = ['group' => '', 'menu_id' => ''], $rowColorOne = '', $rowColorTwo = '', $withManualStriping = false): void
    {
        $this->group = $group;
        $this->withChildren = $withChildren;
        $this->groupMeta = $groupMeta;
        $this->rowColorOne = $rowColorOne;
        $this->rowColorTwo = $rowColorTwo;
        $this->withManualStriping = $withManualStriping;
        $this->uniqueSeed = $uniqueSeed;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Menu::with('children', 'icon');

        if ($this->groupMeta['group'] === 'hotlinks') {
            return $query->where('group', 'hotlinks')
                ->where('menu_id', $this->groupMeta['menu_id']);
        } elseif ($this->groupMeta['group'] != '' && $this->groupMeta['group'] != 'hotlinks') {
            return $query->where('menu_id', $this->groupMeta['menu_id']);
        } else {
            $query->whereNull('menu_id');
        }

        if ($this->group === 'office') {
            return $query->where('group', 'office');
        }

        if ($this->group === 'admin') {
            return $query->where('group', 'admin');
        }

        return $query;
    }


    public function setTableRowId($model)
    {
    //    return Str::slug('menuRow-' . $model->id.Str::random(8), '-');
        return $this->uniqueSeed .'-menuRow-' . $model->id;
    }

    public function columns(): array
    {
        return [
            Column::make(__('Menu'), 'parent.label')
                ->format(function (Menu $model) {
                    return view('frontend.menus.includes.parent-label', ['menu' => $model]);
                }),
            Column::make(__('Group'), 'group')
                ->searchable()
                ->sortable(),
            Column::make(__('Active'), 'active')
                ->searchable()
                ->sortable()
                ->format(function (Menu $model) {
                    return view('frontend.menus.includes.active', ['menu' => $model]);
                }),
            Column::make(__('Label'), 'label')
                ->sortable()
                ->searchable(),
            Column::make(__('Icon'))
                ->format(function (Menu $model) {
                    return view('frontend.menus.includes.icon', ['menu' => $model]);
                }),
            Column::make(__('Navigation'), 'link')
                ->searchable()
                ->sortable(),
            Column::make(__('Menu Items'))
                ->format(function (Menu $model) {
                    return view('frontend.menus.includes.has-children', ['menu' => $model, 'withChildren' => $this->withChildren]);
                }),
            Column::make(__('Actions'))
                ->format(function (Menu $model) {
                    return view('frontend.menus.includes.actions', ['menu' => $model]);
                }),
        ];
    }
}
