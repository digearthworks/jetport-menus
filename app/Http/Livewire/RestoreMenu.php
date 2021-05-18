<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class RestoreMenu extends Component
{
    use AuthorizesRequests,
        HasModel,
        InteractsWithBanner;

    public $confirmingRestore = false;

    public $listeners = ['confirmRestore'];

    public $eloquentRepository = Menu::class;

    public function confirmRestore($id)
    {
        $this->confirmingRestore  = true;
        $this->modelId = $id;
        $this->withTrashed = true;
        $this->dispatchBrowserEvent('showing-confirm-restore-modal');
    }

    public function restore(MenuService $menus)
    {
        $this->authorize('onlysuperadmincandothis');

        $menus->restore($this->model);
        $this->confirmingRestore = false;

        session()->flash('flash.banner', 'Menu Restored!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect('/admin/auth/menus');
    }

    public function render()
    {
        return view('admin.menus.restore', [
            'menu' => $this->model,
        ]);
    }
}
