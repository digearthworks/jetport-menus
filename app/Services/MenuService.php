<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Menu;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class PermissionService.
 */
class MenuService extends BaseService
{
    /**
     * PermissionService constructor.
     *
     * @param  Menu  $menu
     */
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function store(array $data = []): Menu
    {
        $data = $this->filterData($data);

        DB::beginTransaction();

        try {
            $menu = $this->model::create([
                'group' => $data['group'] ?? null,
                'name' => $data['name'] ?? null,
                'handle' => $data['handle'] ?? null,
                'link' => $data['link'] ?? null,
                'type' => $data['type'] ?? null,
                'title' => $data['title'] ?? null,
                'active' => $data['active'] ?? 1,
                'iframe' => $data['iframe'] ?? null,
                // 'sort' => $data['sort'] ?? null,
                // 'row' => $data['row'] ?? null,
                'menu_id' => $data['menu_id'] ?? null,
                'site_page_id' => $data['site_page_id'] ?? null,
                'icon_id' => $data['icon_id'] ?? null,
            ]);

            if (isset($data['sort']) && $data['sort'] > 0) {
                $menu->insertAtSortPosition($data['sort']);
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating the menu.'));
        }

        // event(new RoleCreated($role));

        DB::commit();

        return $menu;
    }


    public function restore(Menu $menu): Menu
    {
        if ($menu->parent()->onlyTrashed()->first()) {
            ($menu->parent()->onlyTrashed()->first())->restore();
        }
        return $this->recursiveOperation($menu, 'restore');
    }

    public function deactivate(Menu $menu)
    {
        return $this->recursiveOperation($menu, 'deactivate');
    }


    public function reactivate(Menu $menu)
    {
        if ($menu->parent()->exists() && !$menu->parent->isActive) {
            $menu->parent->activate();
        }
        return $this->recursiveOperation($menu, 'activate');
    }

    public function update(array $data, Menu $menu)
    {
        DB::beginTransaction();

        try {
            $menu->update([
                'group' => $data['group'] ?? $menu->group,
                'name' => $data['name'] ?? $menu->name,
                'handle' => $data['handle'] ?? null,
                'link' => $data['link'] ?? $menu->link,
                'type' => $data['type'] ?? $menu->type,
                'title' => $data['title'] ?? $menu->title,
                'active' => $data['active'] ?? $menu->active,
                'iframe' => $data['iframe'] ?? $menu->iframe,
                // 'sort' => $data['sort'] ?? $menu->sort,
                // 'row' => $data['row'] ?? $menu->row,
                'menu_id' => $data['menu_id'] ?? ($menu->menu_id ?? null),
                'site_page_id' => $data['site_page_id'] ?? ($menu->site_page_id ?? null),
                'icon_id' => $data['icon_id'] ?? ($menu->icon_id ?? null),
            ]);

            if (isset($data['sort']) && $data['sort'] > 0) {
                $menu->insertAtSortPosition($data['sort']);
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $menu;
    }

    public function saveAs(array $data, Menu $menu)
    {
        DB::beginTransaction();

        try {
            $newMenu = $this->model->create([
                'group' => $data['group'] ?? $menu->group,
                'name' => (isset($data['name']) && $data['name'] === $menu->name) ? $menu->name . '-copy' : ($data['name'] ?? $menu->name . '-copy'),
                'handle' => (isset($data['handle']) && $data['handle'] === $menu->handle) ? $menu->handle . '-copy' : ($data['handle'] ?? $menu->handle . '-copy'),
                'link' => $data['link'] ?? $menu->link,
                'type' => $data['type'] ?? $menu->type,
                'title' => $data['title'] ?? $menu->title,
                'active' => $data['active'] ?? $menu->active,
                'iframe' => $data['iframe'] ?? $menu->iframe,
                'sort' => $data['sort'] ?? $menu->sort,
                // 'row' => $data['row'] ?? $menu->row,
                'menu_id' => $data['menu_id'] ?? ($menu->menu_id ?? null),
                'icon_id' => $data['icon_id'] ?? ($menu->icon_id ?? null),
            ]);

            if ($menu->children()->exists()) {
                foreach ($menu->children as $child) {
                    $clone = $child->replicate();
                    $clone->menu_id = $newMenu->id;
                    $clone->name = $child->name . '-copy';
                    $clone->uuid = Str::Uuid();
                    $clone->save();
                }
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating the Menu.'));
        }

        DB::commit();

        return $menu;
    }

    public function destroy(Menu $menu)
    {
        return $this->recursiveOperation($menu, 'delete');
    }

    private function recursiveOperation(Menu $menu, $operation)
    {
        DB::beginTransaction();

        try {
            if ($menu->children()->exists()) {
                foreach ($menu->children as $child) {
                    $child->$operation();
                }
            }
            if ($operation == 'restore') {
                if ($menu->children()->onlyTrashed()->count()) {
                    foreach ($menu->children()->onlyTrashed()->get() as $trashedChild) {
                        $trashedChild->restore();
                    }
                }
            }
            $menu->$operation();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem ' . $operation . 'ing the menu.'));
        }

        DB::commit();

        return $menu;
    }

    private function querySortCollisions(Menu $menu, $sort)
    {
        return $this->model->buildSortQuery()
            ->where('sort', $sort)
            ->where('id', '!=', $menu->id)
            ->where('menu_id', $menu->menu_id);
    }
}
