<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\BaseEditForm;
use App\Http\Livewire\Concerns\HandlesSelectIconEvent;
use App\Models\Menu;
use App\Services\MenuService;
use App\Support\Concerns\InteractsWithBanner;
use Illuminate\Support\Facades\Validator;

class EditMenuForm extends BaseEditForm
{
    use HandlesSelectIconEvent,
        InteractsWithBanner;

    protected $eloquentRepository = Menu::class;

    public $iconPreview;

    public $listeners = [
        'editDialog',
        'closeEditDialog',
        'selectIcon',
    ];

    /**
     * The create form state.
     *
     * @var array
     */
    public $state = [
        'group' => 'app',
        'name' => '',
        'meta_name' => '',
        'link' => '',
        'type' => 'main_menu',
        'active' => '1',
        'title' => '',
        'iframe' => '0',
        'sort' => '1',
        'menu_id' => '',
        'icon_id' => '',
    ];

    public $item;

    public $data;

    public function editDialog($resourceId, $params = null)
    {
        $params = (array) json_decode($params);

        $this->authorize('onlysuperadmincandothis');

        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['group'] = $this->model->group;
        $this->state['name'] = $this->model->name;
        $this->state['meta_name'] = $this->model->meta_name;
        $this->state['link'] = $this->model->link;
        $this->state['type'] = $this->model->type;
        $this->state['active'] = $this->model->active;
        $this->state['title'] = $this->model->title;
        $this->state['iframe'] = $this->model->iframe;
        $this->state['sort'] = $this->model->sort;
        $this->state['menu_id'] = $this->model->menu_id;
        $this->state['icon_id'] = $this->model->icon->input;
        $this->model->load('icon');

        $this->iconPreview = $this->model->icon->art;

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
        Validator::make($this->state, [
            'group' => ['string'],
            'name' => ['required', 'string'],
            'meta_name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string', 'nullable'],
            'iframe' => ['int'],
            'sort' => ['int', 'nullable'],
        ])->validateWithBag('editMenuForm');

        $menus->update($this->state, $this->model);
        $this->emit('refreshWithSuccess', 'Menu Updated!');
        $this->emit('refreshMenuGrid');
        $this->banner('Menu Updated');
        $this->editingResource = false;
    }

    public function saveMenuAs(MenuService $menus)
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();
        Validator::make($this->state, [
            'group' => ['string'],
            'name' => ['required', 'string'],
            'meta_name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string', 'nullable'],
            'iframe' => ['int'],
            'sort' => ['int', 'nullable'],
        ])->validateWithBag('editMenuForm');

        $menus->saveAs($this->state, $this->model);

        $this->emit('refreshWithSuccess', 'Menu Saved!');
        $this->editingResource = false;
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
