<?php

namespace Turbine\Menus\Http\Livewire\Admin;

use Turbine\Livewire\BaseReactivateDialog;
use Turbine\Menus\Actions\ReactivateMenuItemAction;
use Turbine\Menus\Models\MenuItem;

class ReactivateMenuItemDialog extends BaseReactivateDialog
{
    public $eloquentRepository = MenuItem::class;

    public function reactivateMenuItem(ReactivateMenuItemAction $reactivateMenuItemAction)
    {
        $this->authorize('admin.access.menus');

        $reactivateMenuItemAction($this->model);

        $this->confirmingReactivate = false;

        $this->emit('refreshWithSuccess', 'Menu Saved!');
        $this->emit('refresh-navigation-menu');
        $this->editingResource = false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.reactivate-item', [
            'menuItem' => $this->model,
        ]);
    }
}
