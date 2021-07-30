<?php

namespace App\Turbine\Menus\Http\Livewire\Admin;

use App\Turbine\Livewire\BaseDeleteDialog;
use App\Turbine\Menus\Actions\DeleteMenuItemAction;
use App\Turbine\Menus\Models\MenuItem;

class DeleteMenuItemDialog extends BaseDeleteDialog
{
    public $eloquentRepository = MenuItem::class;

    public function deleteMenuItem(DeleteMenuItemAction $deleteMenuItemAction)
    {
        if (! is_impersonating()) {
            $this->authorize('onlysuperadmincanddothis');
        }

        $deleteMenuItemAction($this->model);

        $this->confirmingDelete = false;

        $this->emit('refreshWithSuccess', 'Menu Deleted');
        $this->emit('refreshMainMenu');
        $this->emit('refreshDashboardMenu');
        $this->emit('refresh-navigation-menu');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.delete-item', [
            'menuItem' => $this->model,
        ]);
    }
}
