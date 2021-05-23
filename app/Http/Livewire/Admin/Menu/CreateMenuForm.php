<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\Admin\BaseCreateForm;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Support\Facades\Validator;

class CreateMenuForm extends BaseCreateForm
{

    /**
     * The create form state.
     *
     * @var array
     */
    public $state = [
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
        'icon_id' => '',
    ];

    public $data;

    public function createDialog($params = [])
    {
        $this->authorize('admin.access.menus');

        if (isset($params['item']) && $params['item']) {
            $this->state['group'] = 'hotlinks';
            $this->state['menu_id'] = isset($params['menu_id']) ? $params['menu_id'] : Menu::first()->id;
        } else {
            $this->state['group'] = 'app';
            $this->state['menu_id'] = null;
        }

        $this->creatingResource = true;

        $this->data = $params;
    }

    public function createMenu(MenuService $menus)
    {
        $this->resetErrorBag();

        $valid = Validator::make($this->state, [
            'group' => ['string', 'required'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string'],
            'iframe' => ['int'],
            'sort' => ['int', 'nullable'],
            'menu_id' => ['int', 'nullable'],
        ])->validateWithBag('createMenuForm');

        $menus->store($this->state);

        $this->emit('refreshWithSuccess', 'Menu Created!');
        $this->emit('closeCreateDialog');
        $this->creatingResource = false;
    }

    public function render()
    {
        return view('admin.menus.create', $this->data ?? []);
    }
}
