<?php

namespace App\Core\Menus\Actions;

use App\Core\Exceptions\GeneralException;
use App\Core\Menus\Models\Menu;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Validator;

class UpdateMenuAction
{
    public function __invoke(array $data, Menu $menu): Menu
    {


        Validator::make($data, [
            'group' => ['string'],
            'name' => ['required', 'string'],
            'handle' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string', 'nullable'],
            'iframe' => ['boolean', 'nullable'],
            'sort' => ['int', 'nullable'],
        ])->validateWithBag('editMenuForm');

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
                'page_id' => $data['page_id'] ?? ($menu->page_id ?? null),
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
