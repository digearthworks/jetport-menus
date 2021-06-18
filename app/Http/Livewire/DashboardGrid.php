<?php

namespace App\Http\Livewire;

use App\Core\Livewire\Concerns\InteractsWithDialog;
use App\Core\Menus\Models\Menu;
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
        return view('dashboard-grid');
    }
}
