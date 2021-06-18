<?php

namespace App\Core\Menus\Actions;

use App\Core\Exceptions\GeneralException;
use App\Core\Menus\Models\Menu;
use App\Core\Support\Concerns\FiltersData;
use DB;
use Exception;
use Illuminate\Support\Facades\Log;

class CreateMenuAction
{
    use FiltersData;

    public function __invoke(array $data = []): Menu
    {
        $data = $this->filterData($data);

        DB::beginTransaction();

        try {
            $menu = Menu::create([
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
                'page_id' => $data['page_id'] ?? null,
                'icon_id' => $data['icon_id'] ?? null,
            ]);

            if (isset($data['sort']) && $data['sort'] > 0) {
                $menu->insertAtSortPosition($data['sort']);
            }
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem creating the menu.'));
        }

        // event(new RoleCreated($role));

        DB::commit();

        return $menu;
    }
}
