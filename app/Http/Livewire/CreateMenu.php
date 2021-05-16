<?php

namespace App\Http\Livewire;

use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CreateMenu extends Component
{
    use AuthorizesRequests,
        InteractsWithBanner;

    public $dd;

    public $creating = false;

    /**
     * The create form state.
     *
     * @var array
     */
    public $form = [
        'group' => 'app',
        'name' => '',
        'link' => '',
        'type' => 'main_menu',
        'active' => '1',
        'title' => '',
        'iframe' => '0',
        'sort' => '1',
        'row' => '',
        'menu_id' => '',
        'icon' => '',
    ];

    public $listeners = ['openCreateDialog'];

    public function openCreateDialog()
    {
        $this->authorize('admin.access.menus');

        $this->creating = true;
    }

    public function create(MenuService $menus)
    {
        $this->resetErrorBag();

        Validator::make($this->form, [
            'group' => ['string'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string'],
            'iframe' => ['int'],
            'sort' => ['int'],
            'menu_id' => ['int'],
        ])->validateWithBag('createMenuForm');

        $menus->store($this->form);
        $this->emit('created');
        $this->emit('closeCreateDialog');
        $this->creating = false;
    }

    public function closeCreateDialog()
    {
        $this->creating = false;
        $this->emit('closeCreateDialog');
    }

    public function render()
    {
        return view('admin.menus.create');
    }
}
