<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\BaseRestoreDialog;
use App\Models\Menu;
use App\Services\MenuService;

class RestoreMenuDialog extends BaseRestoreDialog
{
    public $eloquentRepository = Menu::class;

    public function restoreMenu(MenuService $menus)
    {
        $this->authorize('onlysuperadmincandothis');

        $menus->restore($this->model);
        $this->confirmingRestore = false;

        session()->flash('flash.banner', 'Menu Restored!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.menus');
    }

    public function render()
    {
        return view('admin.menus.restore', [
            'menu' => $this->model,
        ]);
    }
}
