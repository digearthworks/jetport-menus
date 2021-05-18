<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class EditMenu extends Component
{
    use AuthorizesRequests,
        HasModel,
        InteractsWithBanner;

    public $editing = false;

    public $eloquentRepository = Menu::class;

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
        'menu_id' => '',
        'icon' => '',
    ];

    public $item;

    public $data;

    public $listeners = ['openEditor'];

    public function openEditor($id, $params = null)
    {
        $params = (array) json_decode($params);

        $this->authorize('onlysuperadmincandothis');

        $this->editing = true;
        $this->modelId = $id;
        $this->form['group'] = $this->model->group;
        $this->form['name'] = $this->model->name;
        $this->form['link'] = $this->model->link;
        $this->form['type'] = $this->model->type;
        $this->form['active'] = $this->model->active;
        $this->form['title'] = $this->model->title;
        $this->form['iframe'] = $this->model->iframe;
        $this->form['sort'] = $this->model->sort;
        $this->form['menu_id'] = $this->model->menu_id;
        $this->form['icon'] = $this->model->icon_id;

        if ($this->model->menu_id) {
            $this->item = true;
        }

        $this->dispatchBrowserEvent('showing-edit-modal');

        $this->data = $params;
    }

    public function updateMenu(MenuService $menus)
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();
        Validator::make($this->form, [
            'group' => ['string'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string'],
            'iframe' => ['int'],
            'sort' => ['int', 'nullable'],
        ])->validateWithBag('editMenuForm');

        $menus->update($this->form, $this->model);
        $this->emit('itemUpdated');
        $this->editing = false;
    }

    public function saveMenuAs(MenuService $menus)
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();
        Validator::make($this->form, [
            'group' => ['string'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string'],
            'iframe' => ['int'],
            'sort' => ['int', 'nullable'],
        ])->validateWithBag('editMenuForm');

        $menus->saveAs($this->form, $this->model);

        $this->emit('itemUpdated');
        $this->editing = false;
    }

    public function closeEditDialog()
    {
        $this->editing = false;
        $this->emit('closeEditDialog');
    }

    public function render()
    {
        $this->data = array_merge([
            'menu' => $this->model,
        ], $this->data ?? []);

        return view('admin.menus.edit', $this->data);
    }
}
