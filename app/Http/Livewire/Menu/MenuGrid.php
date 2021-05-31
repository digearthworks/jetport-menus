<?php

namespace App\Http\Livewire\Menu;

use App\Http\Livewire\Concerns\HasModel;
use App\Http\Livewire\Concerns\InteractsWithDialog;
use App\Models\Menu;
use App\Services\MenuService;
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

    public function mount($menuId)
    {
        $this->modelId = $menuId;
    }

    public function designerView()
    {
        $this->designerView = ! $this->designerView;
    }

    public function updateSort(MenuService $menus, $list)
    {
        if($this->designerView){

            foreach($list as $item){
                $menus->update(['sort' => $item['order']], Menu::find($item['value']));
            }
        }
    }

    public function render()
    {
        return view('menus.includes.menu-grid', [
            'menu' => $this->model,
        ]);
    }
}
