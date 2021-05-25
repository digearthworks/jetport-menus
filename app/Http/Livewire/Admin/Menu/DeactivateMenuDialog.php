<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\Admin\BaseDeactivateDialog;
use App\Models\Menu;
use App\Services\MenuService;

class DeactivateMenuDialog extends BaseDeactivateDialog
{
    public $eloquentRepository = Menu::class;

    public function deactivateMenu(MenuService $menus)
    {
        $this->authorize('admin.access.menus');

        $menus->deactivate($this->model);
        $this->confirmingDeactivate = false;


        session()->flash('flash.banner', 'Menu Deactivated!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.menus.deactivated');
    }

    public function render()
    {
        return view('admin.menus.deactivate', [
            'menu' => $this->model,
        ]);
    }
}
