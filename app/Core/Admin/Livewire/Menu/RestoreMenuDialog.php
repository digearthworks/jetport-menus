<?php

namespace App\Core\Admin\Livewire\Menu;

use App\Core\Livewire\BaseRestoreDialog;
use App\Core\Menus\Actions\RestoreMenuAction;
use App\Core\Menus\Models\Menu;

class RestoreMenuDialog extends BaseRestoreDialog
{
    public $eloquentRepository = Menu::class;

    public function restoreMenu(RestoreMenuAction $restoreMenuAction)
    {
        $this->authorize('onlysuperadmincandothis');

        $restoreMenuAction($this->model);

        $this->confirmingRestore = false;

        session()->flash('flash.banner', 'Menu Restored!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect()->route('admin.menus');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.menus.restore', [
            'menu' => $this->model,
        ]);
    }
}
