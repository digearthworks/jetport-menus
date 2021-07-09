<?php

namespace Turbine\Menus\Actions;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Rules\EnumRule;
use Turbine\Concerns\FiltersData;
use Turbine\Exceptions\GeneralException;
use Turbine\Menus\Enums\MenuItemTargetEnum;
use Turbine\Menus\Enums\MenuItemTemplateEnum;
use Turbine\Menus\Enums\MenuItemTypeEnum;
use Turbine\Menus\Models\MenuItem;

class CreateMenuItemAction
{
    use FiltersData;

    public function __invoke(array $data = []): MenuItem
    {
        $data = $this->filterData($data);

        Validator::make($data, [
            'type' => ['required', new EnumRule(MenuItemTypeEnum::class)],
            'template' => ['required', new EnumRule(MenuItemTemplateEnum::class)],
            'target' => [new EnumRule(MenuItemTargetEnum::class)],
            'route' => ['string', 'nullable'],
            'handle' => ['required', 'string', Rule::unique('menu_items')],
            'uri' => ['string', 'nullable'],
            'active' => ['bool'],
            'attach_for_user' => ['bool', 'nullable'],
            'title' => ['string', 'nullable'],
            'sort' => ['int', 'nullable'],
            'menu_id' => ['int', 'nullable', Rule::exists('menus', 'id')],
            'page_id' => ['int', 'nullable', Rule::exists('pages', 'id')],
            'parent_id' => ['int', 'nullable', Rule::exists('menu_items', 'id')],
        ])->validateWithBag('createMenuItemForm');

        DB::beginTransaction();

        try {
            $menuItem = MenuItem::create([
                'type' => $data['type'],
                'template' => $data['template'],
                'target' => $data['target'],
                'route' => $data['route'] ?? null,
                'name' => $data['name'],
                'handle' => $data['handle'],
                'uri' => $data['uri'] ?? null,
                'active' => $data['active'] ?? true,
                'title' => $data['title'] ?? null,
                'menu_id' => $data['menu_id'] ?? null,
                'icon_id' => $data['icon_id'] ?? null,
                'page_id' => $data['page_id'] ?? null,
                'parent_id' => $data['parent_id'] ?? null,
            ]);

            if (isset($data['sort']) && $data['sort'] > 0) {
                $menuItem->insertAtSortPosition($data['sort']);
            }

            if (isset($data['attach_for_user']) && $data['attach_for_user']) {
                if ($menuItem->parentItem()->exists()) {
                    Auth::user()->menuItems()->attach($menuItem->parentItem->id);
                }
                Auth::user()->menuItems()->attach($menuItem->id);
            }
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            if (app()->environment(['local', 'testing'])) {
                throw $e;
            }

            throw new GeneralException(__('There was a problem creating the menu.'));
        }

        DB::commit();

        return $menuItem;
    }
}
