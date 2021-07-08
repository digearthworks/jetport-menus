<?php

namespace Turbine\Menus\Http\Livewire\Admin;

use Turbine\Livewire\BaseRestoreDialog;
use Turbine\Menus\Actions\RestoreMenuItemAction;
use Turbine\Menus\Models\MenuItem;

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
