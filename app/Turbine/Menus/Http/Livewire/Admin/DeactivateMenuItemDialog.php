<?php

namespace App\Turbine\Menus\Http\Livewire\Admin;

use App\Turbine\Livewire\BaseDeactivateDialog;
use App\Turbine\Menus\Actions\DeactivateMenuItemAction;
use App\Turbine\Menus\Models\MenuItem;

class DeactivateMenuItemDialog extends BaseDeactivateDialog
{
    public $eloquentRepository = MenuItem::class;

    public function deactivateMenuItem(DeactivateMenuItemAction $deactivateMenuItemAction)
    {
        $this->authorize('admin.access.menus');

        $deactivateMenuItemAction($this->model);

        $this->confirmingDeactivate = false;

        $this->emit('refresh-navigation-menu');
        $this->emit('refreshWithSuccess', 'Menu Deleted');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.deactivate-item', [
            'menu' => $this->model,
        ]);
    }
}
