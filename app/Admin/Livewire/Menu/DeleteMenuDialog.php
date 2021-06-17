<?php

namespace App\Admin\Livewire\Menu;

use App\Http\Livewire\BaseDeleteDialog;
use App\Menus\Actions\DeleteMenuAction;
use App\Menus\Models\Menu;

class DeleteMenuDialog extends BaseDeleteDialog
{
    public $eloquentRepository = Menu::class;

    public function deleteMenu(DeleteMenuAction $deleteMenuAction)
    {
        $this->authorize('onlysuperadmincanddothis');

        $deleteMenuAction($this->model);

        $this->confirmingDelete = false;

        session()->flash('flash.banner', 'Menu Deleted!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.menus.deleted');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.delete', [
            'menu' => $this->model,
        ]);
    }
}
