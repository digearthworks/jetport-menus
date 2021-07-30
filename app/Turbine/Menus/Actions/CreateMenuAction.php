<?php

namespace App\Turbine\Menus\Actions;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Rules\EnumRule;
use App\Turbine\Concerns\FiltersData;
use App\Turbine\Exceptions\GeneralException;
use App\Turbine\Menus\Enums\MenuTemplateEnum;
use App\Turbine\Menus\Enums\MenuTypeEnum;
use App\Turbine\Menus\Models\Menu;

class CreateMenuAction
{
    use FiltersData;

    public function __invoke(array $data): Menu
    {
        $data = $this->filterData($data);

        Validator::make($data, [
            'title' => ['string', 'nullable'],
            'name' => ['required', 'string'],
            'handle' => ['required', 'string', Rule::unique('menus')],
            'type' => ['required', new EnumRule(MenuTypeEnum::class)],
            'template' => [new EnumRule(MenuTemplateEnum::class), 'nullable'],
            'active' => ['bool', 'nullable'],
            'sort' => ['int', 'nullable'],
        ])->validateWithBag('createMenuForm');

        DB::beginTransaction();

        try {
            $menu = Menu::create([
                'title' => $data['title'] ?? null,
                'name' => $data['name'],
                'handle' => $data['handle'],
                'type' => $data['type'],
                'active' => $data['active'] ?? true,
                'template' => $data['template'] ?? null,
                'icon_id' => $data['icon_id'] ?? null,
            ]);

            if (isset($data['sort']) && $data['sort'] > 0) {
                $menu->insertAtSortPosition($data['sort']);
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;

            // dd($e->getMessage());
            Log::error($e->getMessage());

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $menu;
    }
}
