<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeactivateMenu extends Component
{
    use AuthorizesRequests,
        HasModel,
        InteractsWithBanner;

    public $confirmingDeactivate = false;

    public $eloquentRepository = Menu::class;

    public $listeners = ['confirmDeactivate'];

    public function confirmDeactivate($id)
    {
        $this->confirmingDeactivate  = true;
        $this->modelId = $id;
        $this->dispatchBrowserEvent('showing-confirm-deactivate-modal');
    }

    public function deactivate(MenuService $menus)
    {
        $this->authorize('admin.access.menus');

        $menus->deactivate($this->model);
        $this->confirmingDeactivate = false;


        session()->flash('flash.banner', 'Menu Deactivated!.');
        session()->flash('falsh.bannerStyle', 'success');

        return redirect('/admin/auth/menus/deactivated');
    }

    public function render()
    {
        return view('admin.menus.deactivate', [
            'menu' => $this->model,
        ]);
    }
}
