<?php

namespace App\Admin\Livewire\Menu;

use App\Http\Livewire\BaseRestoreDialog;
use App\Menus\Actions\RestoreMenuAction;
use App\Menus\Models\Menu;

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
