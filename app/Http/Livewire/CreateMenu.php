<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CreateMenu extends Component
{
    use AuthorizesRequests,
        InteractsWithBanner;

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
        'sort' => '',
        'row' => '',
        'menu_id' => '',
        'icon' => '',
    ];

    public $data;

    public $listeners = ['openCreateDialog'];


    public function openCreateDialog($params = [])
    {
        $this->authorize('admin.access.menus');

        if (isset($params['item']) && $params['item']) {
            $this->form['group'] = 'hotlinks';
            $this->form['menu_id'] = isset($params['menu_id']) ? $params['menu_id'] : Menu::first()->id;
        } else {
            $this->form['group'] = 'app';
            $this->form['menu_id'] = null;
        }

        $this->creating = true;

        $this->data = $params;
    }

    public function create(MenuService $menus)
    {
        $this->resetErrorBag();

        $valid = Validator::make($this->form, [
            'group' => ['string', 'required'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string'],
            'iframe' => ['int'],
            'sort' => ['int', 'nullable'],
            'menu_id' => ['int', 'nullable'],
        ])->validateWithBag('createMenuForm');

        $menus->store($this->form);

        $this->emit('menuCreated');
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
        return view('admin.menus.create', $this->data ?? []);
    }
}
