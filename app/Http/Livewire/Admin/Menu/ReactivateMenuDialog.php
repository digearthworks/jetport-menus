<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\BaseReactivateDialog;
use App\Menus\Models\Menu;
use App\Services\MenuService;

class ReactivateMenuDialog extends BaseReactivateDialog
{
    public $eloquentRepository = Menu::class;

    public function reactivateMenu(MenuService $menus)
    {
        $this->authorize('admin.access.menus');

        $menus->reactivate($this->model);
        $this->confirmingReactivate = false;

        session()->flash('flash.banner', 'Menu Reactivated!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.menus');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.reactivate', [
            'menu' => $this->model,
        ]);
    }
}
