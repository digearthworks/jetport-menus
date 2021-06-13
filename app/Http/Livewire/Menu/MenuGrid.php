<?php

namespace App\Http\Livewire\Menu;

use App\Http\Livewire\Concerns\HasModel;
use App\Http\Livewire\Concerns\InteractsWithDialog;
use App\Models\Menu;
use Livewire\Component;

class MenuGrid extends Component
{
    use HasModel,
        InteractsWithDialog;

    public $listeners = [
        'refreshMenuGrid' => '$refresh',
        'designerView' => 'designerView',
    ];

    protected $eloquentRepository = Menu::class;

    public $designerView = false;

    public function mount($menuId): void
    {
        $this->modelId = $menuId;
    }

    public function designerView(): void
    {
        $this->designerView = ! $this->designerView;
    }

    public function updateSort($list): void
    {
        if ($this->designerView) {
            foreach ($list as $item) {
                Menu::find($item['value'])->update(['sort' => $item['order']]);
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('menus.includes.menu-grid', [
            'menu' => $this->model,
        ]);
    }
}
