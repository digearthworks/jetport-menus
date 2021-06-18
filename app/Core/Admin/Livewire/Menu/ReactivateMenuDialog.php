<?php

namespace App\Core\Admin\Livewire\Menu;

use App\Core\Livewire\BaseReactivateDialog;
use App\Core\Menus\Actions\ReactivateMenuAction;
use App\Core\Menus\Models\Menu;

class ReactivateMenuDialog extends BaseReactivateDialog
{
    public $eloquentRepository = Menu::class;

    public function reactivateMenu(ReactivateMenuAction $reactivateMenuAction)
    {
        $this->authorize('admin.access.menus');

        $reactivateMenuAction($this->model);

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
