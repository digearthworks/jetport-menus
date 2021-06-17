<?php

namespace App\Menus\Actions;

use App\Exceptions\GeneralException;
use App\Menus\Models\Menu;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SaveAsMenuAction
{
    public function __invoke(array $data, Menu $menu): Menu
    {
        DB::beginTransaction();

        try {
            $newMenu = Menu::create([
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

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem creating the Menu.'));
        }

        DB::commit();

        return $menu;
    }
}
