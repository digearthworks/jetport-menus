<?php

namespace Turbine\Menus\Http\Livewire;

use Livewire\Component;
use Turbine\Livewire\Concerns\HasModel;
use Turbine\Livewire\Concerns\InteractsWithDialog;
use Turbine\Menus\Models\MenuItem;

class MainMenu extends Component
{
    use HasModel;
    use InteractsWithDialog;

    public $listeners = [
        'refreshMainMenu' => '$refresh',
        'designerView' => 'designerView',
    ];

    protected $eloquentRepository = MenuItem::class;

    public $designerView;

    public $parent;

    public function mount($parentId, $designerView = false): void
    {
        $this->modelId = $parentId;
        $this->designerView = $designerView;
    }

    public function designerView(): void
    {
        $this->designerView = ! $this->designerView;
    }

    public function updateSort($list): void
    {
        foreach ($list as $item) {
            MenuItem::find($item['value'])->update(['sort' => $item['order']]);
        }
        $this->emit('refresh-navigation-menu');
        $this->render();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->parent = $this->model;

        return view('menu.main.'. $this->model->menu->template.'.index');
    }
}
