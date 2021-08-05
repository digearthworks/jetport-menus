<?php

declare(strict_types = 1);

namespace App\Turbine\Menus\Actions;

use App\Turbine\Concerns\FiltersData;
use App\Turbine\Exceptions\GeneralException;
use App\Turbine\Menus\Enums\MenuItemTargetEnum;
use App\Turbine\Menus\Enums\MenuItemTemplateEnum;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\Models\MenuItem;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Rules\EnumRule;

class UpdateMenuItemAction
{
    use FiltersData;

    public function __invoke(array $data, MenuItem $menuItem): MenuItem
    {
        $data = $this->filterData($data);

        Validator::make($data, [
            'name' => ['string', 'required'],
            'type' => [new EnumRule(MenuItemTypeEnum::class)],
            'template' => [new EnumRule(MenuItemTemplateEnum::class)],
            'target' => [new EnumRule(MenuItemTargetEnum::class)],
            'route' => ['string', 'nullable'],
            'handle' => ['string', Rule::unique('menu_items')->ignore($menuItem->id)],
            'handle' => ['string'],
            'uri' => ['string', 'nullable'],
            'active' => ['bool'],
            'title' => ['string', 'nullable'],
            'sort' => ['int', 'nullable'],
            'menu_id' => ['int', 'nullable', Rule::exists('menus', 'id')],
            'page_id' => ['int', 'nullable', Rule::exists('pages', 'id')],
            'parent_id' => ['int', 'nullable', Rule::exists('menu_items', 'id')],
        ])->validateWithBag('createMenuItemForm');


        DB::beginTransaction();

        try {
            $menuItem->update([
                'type' => $data['type'] ?? $menuItem->type,
                'template' => $data['template'] ?? $menuItem->template,
                'target' => $data['target'] ?? $menuItem->target,
                'route' => $data['route'] ?? $menuItem->route,
                'name' => $data['name'] ?? $menuItem->name,
                'handle' => $data['handle'] ?? $menuItem->handle,
                'uri' => $data['uri'] ?? $menuItem->uri,
                'active' => $data['active'] ?? $menuItem->active,
                'title' => $data['title'] ?? $menuItem->title,
                'menu_id' => $data['menu_id'] ?? $menuItem->menu_id,
                'icon_id' => $data['icon_id'] ?? $menuItem->icon_id,
                'page_id' => $data['page_id'] ?? $menuItem->page_id,
                'parent_id' => $data['parent_id'] ?? $menuItem->parent_id,
            ]);

            if (isset($data['sort']) && $data['sort'] > 0) {
                $menuItem->insertAtSortPosition($data['sort']);
            }
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException('There was a problem updating the Menu');
        }

        DB::commit();

        return $menuItem;
    }
}
