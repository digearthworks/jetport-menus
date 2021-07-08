<?php

namespace Turbine\Menus\Http\Livewire\Admin;

use Turbine\Concerns\InteractsWithBanner;
use Turbine\Livewire\BaseEditForm;
use Turbine\Livewire\Concerns\HandlesSelectIconEvent;
use Turbine\Menus\Actions\SaveAsMenuItemAction;
use Turbine\Menus\Actions\UpdateMenuItemAction;
use Turbine\Menus\Enums\MenuItemTypeEnum;
use Turbine\Menus\Models\MenuItem;
use Turbine\Pages\Models\Page;

class EditMenuItemForm extends BaseEditForm
{
    use HandlesSelectIconEvent;
    use InteractsWithBanner;

    protected $eloquentRepository = MenuItem::class;

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
        'name' => '',
        'handle' => '',
        'uri' => '',
        'type' => MenuItem::class,
        'template' => 'default',
        'target' => '_self',
        'active' => '1',
        'title' => '',
        'sort' => '',
        'parent_id' => '',
        'menu_id' => '',
        'page_id' => '',
        'icon_id' => '',
    ];

    public $item;

    public $data;

    public function editDialog($resourceId, $params = null)
    {
        $params = (array) json_decode($params);

        if (! is_impersonating()) {
            $this->authorize('onlysuperadmincandothis');
        }

        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['name'] = $this->model->name;
        $this->state['handle'] = $this->model->handle;
        $this->state['uri'] = $this->model->uri;
        $this->state['type'] = $this->model->type;
        $this->state['template'] = $this->model->template;
        $this->state['active'] = $this->model->active;
        $this->state['title'] = $this->model->title;
        $this->state['sort'] = $this->model->sort;
        $this->state['menu_id'] = $this->model->menu_id;
        $this->state['parent_id'] = $this->model->parent_id;
        $this->state['page_id'] = $this->model->page_id;
        $this->state['icon_id'] = $this->model->icon->input;
        $this->model->load('icon', 'page');

        $this->iconPreview = $this->model->icon->name ?? 'carbon-no-image-32';

        if ($this->model->parent_id) {
            $this->item = true;
        }

        $this->dispatchBrowserEvent('showing-edit-modal');

        $this->data = $params;
    }

    public function updateMenu(UpdateMenuItemAction $updateMenuItemAction)
    {
        if (! is_impersonating()) {
            $this->authorize('is_admin');
        }

        $this->resetErrorBag();

        $updateMenuItemAction($this->state, $this->model);

        $this->emit('refreshWithSuccess', 'Menu Updated!');
        $this->emit('refresh-navigation-menu');
        $this->emit('refreshMainMenu');
        $this->emit('refreshDashboardMenu');
        $this->banner('Menu Updated');
        $this->editingResource = false;
    }

    public function saveMenuItemAs(SaveAsMenuItemAction $saveAsMenuItemAction)
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();

        $saveAsMenuItemAction($this->state, $this->model);

        $this->emit('refreshWithSuccess', 'Menu Saved!');
        $this->emit('refresh-navigation-menu');
        $this->editingResource = false;
    }

    public function closeEditDialog()
    {
        $this->editing = false;
        $this->emit('closeEditDialog');
    }

    public function setUpSelects()
    {
        if ($this->state['type'] === MenuItemTypeEnum::page_link()->value) {
            $this->state['page_id'] = $this->state['page_id'] ? $this->state['page_id'] : Page::first()->id;
        }
    }

    public function render()
    {
        $this->data = array_merge([
            'menuItem' => $this->model,
        ], $this->data ?? []);

        return view('admin.menus.edit-item', $this->data);
    }
}
