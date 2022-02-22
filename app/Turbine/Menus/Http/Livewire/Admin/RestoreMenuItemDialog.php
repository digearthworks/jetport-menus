<?php

namespace App\Turbine\Menus\Http\Livewire\Admin;

use App\Turbine\Livewire\BaseRestoreDialog;
use App\Turbine\Menus\Actions\RestoreMenuItemAction;
use App\Turbine\Menus\Models\MenuItem;

class RestoreMenuItemDialog extends BaseRestoreDialog
{
    public $eloquentRepository = MenuItem::class;

    public function restoreMenuItem(RestoreMenuItemAction $restoreMenuAction)
    {
        $this->authorize('onlysuperadmincandothis');

        $restoreMenuAction($this->model);

        $this->confirmingRestore = false;

        $this->emit('refreshWithSuccess', 'Menu Restored');
        $this->emit('refresh-navigation-menu');
        $this->editingResource = false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.restore-item', [
            'menuItem' => $this->model,
        ]);
    }
}
