<?php

namespace App\MenuSystem;

use App\Models\Menu;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

class MenuService extends BaseService
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function store(array $data = []): Menu
    {
        DB::beginTransaction();

        try {
            $menu = $this->model::create([
                'group' => $data['group'] ?? null,
                'label' => $data['label'] ?? null,
                'link' => $data['link'] ?? null,
                'type' => $data['type'] ?? null,
                'title' => $data['title'] ?? null,
                'active' => $data['active'] ?? 1,
                'iframe' => $data['iframe'] ?? null,
                'sort' => $data['sort'] ?? null,
                'row' => $data['row'] ?? null,
                'menu_id' => $data['menu_id'] ?? null,
                'icon_id' => $data['icon'] ?? null,
                'permission_id' => $data['permission_id'] ?? null,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $menu;
    }

    public function getMenuGrid(Menu $menu)
    {
        return $menu->grid;
    }

    public function getGroupMetaForHotlinkChildren(Menu $menu = null)
    {
        if ($menu) {
            if ($menu->menu_id === null) {
                return ['group' => 'hotlinks', 'menu_id' => $menu->id];
            }
        }

        return [];
    }

    public function menuHasHotlinks(Menu $menu = null)
    {
        if ($menu) {
            return $menu->children()->where('group', 'hotlinks')->exists();
        }

        return false;
    }

    public function menuHasItems(Menu $menu = null) : bool
    {
        if ($menu) {
            return $menu->children()->exists();
        }

        return false;
    }

    public function getGroupMetaForItems(Menu $menu = null) : array
    {
        if ($menu) {
            return $menu->getGroupMetaForItems();
        }

        return [];
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        DB::beginTransaction();

        try { //array_key_exists('icon', $data) && !empty($data['icon'])

            $data = $request->all();

            $menu->update([
                'group' => $data['group'] ?? $menu->group,
                'label' => $data['label'] ?? $menu->label,
                'link' => $data['link'] ?? $menu->link,
                'type' => $data['type'] ?? $menu->type,
                'title' => $data['title'] ?? $menu->title,
                'active' => $data['active'] ?? $menu->active,
                'iframe' => $data['iframe'] ?? $menu->iframe,
                'sort' => $data['sort'] ?? $menu->sort,
                'row' => $data['row'] ?? $menu->row,
                'menu_id' => $data['menu_id'] ?? ($menu->menu_id ?? null),
                'icon_id' => $data['icon'] ?? ($menu->icon_id ?? null),
                'permission_id' => $data['permission_id'] ?? $menu->permission_id,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        DB::commit();

        return $menu;
    }

    public function destroy(Menu $menu)
    {
        return $this->deleteById($menu->id);
    }

    public function getAllMenusInGroup($group)
    {
        return $this->model->whereNull('menu_id')->where('group', $group)->orderBy('sort')->with('children', 'icon')->get();
    }

    public function getMenu(Menu $menu)
    {
        return $this->model->where('id', $menu->id)->with('children', 'icon')->first();
    }

    public function getAllMenus()
    {
        return $this->model->whereNull('menu_id')->orderBy('sort')->orderby('id')->with('children', 'icon')->get();
    }

    public function getMainMenus()
    {
        return $this->model->whereNull('menu_id')->where('type', 'main_menu')->get();
    }

    public function getParentMenu($parentId = null)
    {
        if ($parentId) {
            return $this->getById($parentId);
        }

        return '';
    }
}
