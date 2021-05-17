<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeleteMenu extends Component
{
    use AuthorizesRequests,
        HasModel,
        InteractsWithBanner;

    public $eloquentRepository = Menu::class;

    public $confirmingDelete = false;

    public $listeners = ['confirmDelete'];

    public function confirmDelete($id)
    {
        $this->confirmingDelete  = true;
        $this->modelId = $id;
        $this->dispatchBrowserEvent('showing-confirm-delete-modal');
    }

    public function delete(MenuService $menus)
    {
        $this->authorize('onlysuperadmincanddothis');

        $menus->destroy($this->model);
        $this->confirmingDelete = false;

        request()->session()->flash('flash.banner', 'Menu Deleted!.');
        request()->session()->flash('falsh.bannerStyle', 'success');

        return redirect('/admin/auth/menus/deleted');
    }

    public function render()
    {
        return view('admin.menus.delete', [
            'menu' => $this->model,
        ]);
    }
}
