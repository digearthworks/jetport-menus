<?php

namespace App\Turbine\Menus\Actions;

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
use Str;

class SaveAsMenuItemAction
{
    public function __invoke(array $data, MenuItem $menuItem) : MenuItem
    {
        Validator::make($data, [
            'name' => ['string', 'required'],
            'type' => [new EnumRule(MenuItemTypeEnum::class)],
            'template' => [new EnumRule(MenuItemTemplateEnum::class)],
            'target' => [new EnumRule(MenuItemTargetEnum::class)],
            'route' => ['string', 'nullable'],
            'handle' => ['string', Rule::unique('menu_items')->ignore($menuItem->id)],
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
            $newMenuItem = MenuItem::create([
                'type' => $data['type'] ?? $menuItem->type,
                'template' => $data['template'] ?? $menuItem->template,
                'target' => $data['target'] ?? $menuItem->target,
                'route' => $data['route'] ?? $menuItem->route,
                'name' => (isset($data['name']) && $data['name'] === $menuItem->name) ? $menuItem->name.'-copy' : ($data['name'] ?? $menuItem->name.'-copy'),
                'handle' => (isset($data['handle']) && $data['handle'] === $menuItem->handle) ? $menuItem->handle.'-copy' : ($data['handle'] ?? $menuItem->handle.'-copy'),
                'uri' => $data['uri'] ?? $menuItem->uri,
                'active' => $data['active'] ?? $menuItem->active,
                'title' => $data['title'] ?? $menuItem->title,
                'menu_id' => $data['menu_id'] ?? $menuItem->menu_id,
                'page_id' => $data['page_id'] ?? $menuItem->page_id,
                'parent_id' => $data['parent_id'] ?? $menuItem->parent_id,
            ]);

            if (isset($data['sort']) && $data['sort'] > 0) {
                $newMenuItem->insertAtSortPosition($data['sort']);
            }

            if ($menuItem->allChildren()->exists()) {
                foreach ($menuItem->allChildren as $child) {
                    $clone = $child->replicate();
                    $clone->parent_id = $newMenuItem->id;
                    $clone->name = $child->name.'-copy';
                    $clone->handle = $child->handle.'-copy';
                    $clone->uuid = Str::Uuid();
                    $clone->save();
                }
            }
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            if (app()->environment(['local', 'testing'])) {
                throw $e;
            }

            throw new GeneralException('There was a problem updating the Menu');
        }

        DB::commit();

        return $newMenuItem;
    }
}
