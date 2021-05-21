<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\Admin\BaseDeleteDialog;
use App\Models\Menu;
use App\Services\MenuService;

class DeleteMenuDialog extends BaseDeleteDialog
{
    public $eloquentRepository = Menu::class;

    public function deleteMenu(MenuService $menus)
    {
        $this->authorize('onlysuperadmincanddothis');

        $menus->destroy($this->model);

        $this->confirmingDelete = false;

        session()->flash('flash.banner', 'Menu Deleted!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.menus.deleted');
    }

    public function render()
    {
        return view('admin.menus.delete', [
            'menu' => $this->model,
        ]);
    }
}
