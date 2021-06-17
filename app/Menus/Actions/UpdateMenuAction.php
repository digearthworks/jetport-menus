<?php

namespace App\Menus\Actions;

use App\Exceptions\GeneralException;
use App\Menus\Models\Menu;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;

class UpdateMenuAction
{
    public function __invoke(array $data, Menu $menu): Menu
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

            Log::error($e->getMessage());

            throw new GeneralException('There was a problem updating the Menu');
        }

        DB::commit();

        return $menu;
    }
}
