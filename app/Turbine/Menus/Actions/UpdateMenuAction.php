<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Concerns\FiltersData;
use App\Turbine\Exceptions\GeneralException;
use App\Turbine\Menus\Enums\MenuTemplateEnum;
use App\Turbine\Menus\Enums\MenuTypeEnum;
use App\Turbine\Menus\Models\Menu;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Enum\Laravel\Rules\EnumRule;

class UpdateMenuAction
{
    use FiltersData;

    public function __invoke(array $data, Menu $menu): Menu
    {
        $data = $this->filterData($data);

        Validator::make($data, [
            'title' => ['string', 'nullable'],
            'name' => ['string'],
            'handle' => ['string'],
            'type' => [new EnumRule(MenuTypeEnum::class)],
            'template' => [new EnumRule(MenuTemplateEnum::class), 'nullable'],
            'active' => ['bool', 'nullable'],
            'sort' => ['int', 'nullable'],
        ])->validateWithBag('createMenuForm');

        DB::beginTransaction();

        try {
            $menu->update([
                'title' => $data['title'] ?? $menu->id,
                'name' => $data['name'] ?? $menu->name,
                'handle' => $data['handle'] ?? $menu->handle,
                'type' => $data['type'] ?? $menu->type,
                'active' => $data['active'] ?? $menu->active,
                'template' => $data['template'] ?? $menu->template,
                'icon_id' => $data['icon_id'] ?? $menu->icon_id,
            ]);

            if (isset($data['sort']) && $data['sort'] > 0) {
                $menu->insertAtSortPosition($data['sort']);
            }
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $menu;
    }
}
