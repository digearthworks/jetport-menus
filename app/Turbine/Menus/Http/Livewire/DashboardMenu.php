<?php

namespace App\Turbine\Menus\Http\Livewire;

use App\Turbine\Livewire\Concerns\InteractsWithDialog;
use App\Turbine\Menus\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardMenu extends Component
{
    use InteractsWithDialog;

    public $listeners = [
        'refreshDashboardMenu' => '$refresh',
        'designerView' => 'designerView',
    ];

    public $designerView;

    public $menuItems;

    public function mount($designerView = false)
    {
        $this->designerView = $designerView;
        // $this->menuItems = collect(Auth::user()->getAllMenuItems());
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
        $this->menuItems = collect(Auth::user()->getAllMenuItems());

        return view('menu.dashboard.default.index');
    }
}
