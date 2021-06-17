<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\BaseDeactivateDialog;
use App\Menus\Actions\DeactivateMenuAction;
use App\Menus\Models\Menu;

class DeactivateMenuDialog extends BaseDeactivateDialog
{
    public $eloquentRepository = Menu::class;

    public function deactivateMenu(DeactivateMenuAction $deactivateMenuAction)
    {
        $this->authorize('admin.access.menus');

        $deactivateMenuAction($this->model);

        $this->confirmingDeactivate = false;


        session()->flash('flash.banner', 'Menu Deactivated!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.menus.deactivated');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.deactivate', [
            'menu' => $this->model,
        ]);
    }
}
