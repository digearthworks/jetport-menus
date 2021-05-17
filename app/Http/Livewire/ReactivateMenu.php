<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class ReactivateMenu extends Component
{
    use AuthorizesRequests,
        HasModel,
        InteractsWithBanner;

    public $confirmingReactivate = false;

    public $listeners = ['confirmReactivate'];


    public $eloquentRepository = Menu::class;

    public function confirmReactivate($id)
    {
        $this->confirmingReactivate  = true;
        $this->modelId = $id;
        $this->dispatchBrowserEvent('showing-confirm-reactivate-modal');
    }

    public function reactivate(MenuService $menus)
    {
        $this->authorize('admin.access.menus');

        $menus->reactivate($this->model);
        $this->confirmingReactivate = false;

        request()->session()->flash('flash.banner', 'Menu Reactivated!.');
        request()->session()->flash('falsh.bannerStyle', 'success');

        return redirect('/admin/auth/menus');
    }

    public function render()
    {
        return view('admin.menus.reactivate', [
            'menu' => $this->model,
        ]);
    }
}
