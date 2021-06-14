<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Concerns\InteractsWithDialog;
use App\Menus\Models\Menu;
use Livewire\Component;

class DashboardGrid extends Component
{
    use InteractsWithDialog;

    public $listeners = [
        'refreshMenuGrid' => '$refresh',
        'designerView' => 'designerView',
    ];

    public $designerView = false;

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
        return view('includes.dashboard-grid');
    }
}
