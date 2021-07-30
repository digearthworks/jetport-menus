<?php

namespace App\Turbine\Menus\Http\Livewire\Admin;

use App\Turbine\Concerns\InteractsWithBanner;
use App\Turbine\Livewire\BaseCreateForm;
use App\Turbine\Livewire\Concerns\HandlesSelectIconEvent;
use App\Turbine\Menus\Actions\CreateMenuItemAction;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\Models\Menu;
use App\Turbine\Menus\Models\MenuItem;
use App\Turbine\Pages\Models\Page;

class CreateMenuItemForm extends BaseCreateForm
{
    use HandlesSelectIconEvent;
    use InteractsWithBanner;

    /**
     * The create form state.
     *
     * @var array
     */
    public $state = [
        'name' => '',
        'handle' => '',
        'uri' => null,
        'type' => MenuItem::class,
        'template' => 'default',
        'target' => '_self',
        'active' => '1',
        'title' => '',
        'sort' => '',
        'parent_id' => null,
        'menu_id' => null,
        'page_id' => null,
        'icon_id' => null,
        'attach_for_user' => false,
    ];

    public $listeners = [
        'createDialog',
        'closeCreateDialog',
        'selectIcon',
    ];

    public $data;

    public $iconPreview;

    public function createDialog($params = [])
    {
        if (! is_impersonating()) {
            $this->authorize('admin.access.menus');
        }
        $this->emit('selectIcon', 'carbon-no-image-32');

        if (isset($params['attach_for_user']) && $params['attach_for_user']) {
            $this->state['attach_for_user'] = true;
        }


        if (isset($params['item']) && $params['item']) {
            $this->state['type'] = MenuItemTypeEnum::internal_link();
            $this->state['parent_id'] = isset($params['parent_id']) ? $params['parent_id'] : MenuItem::first()->id;
            $this->state['menu_id'] = isset($params['menu_id']) ? $params['menu_id'] : null;
        } else {
            $this->state['type'] = MenuItemTypeEnum::menu_item();
            $this->state['parent_id'] = null;
            $this->state['menu_id'] = isset($params['menu_id']) ? $params['menu_id'] : Menu::first()->id;
        }

        $this->creatingResource = true;

        $this->data = $params;
    }

    public function createMenuItem(CreateMenuItemAction $createMenuItemAction)
    {
        $createMenuItemAction($this->state);

        $this->emit('refreshWithSuccess', 'Menu Created!');
        $this->emit('closeCreateDialog');
        $this->emit('refresh-navigation-menu');
        $this->emit('refreshMainMenu');
        $this->emit('refreshDashboardMenu');
        $this->banner('Menu Item Created');
        $this->creatingResource = false;
    }

    public function setUpSelects()
    {
        if ($this->state['type'] === MenuItemTypeEnum::page_link()->value) {
            $this->state['page_id'] = $this->state['page_id'] ? $this->state['page_id'] : Page::first()->id;
        }
    }

    public function render()
    {
        return view('admin.menus.create-item', $this->data ?? []);
    }
}
