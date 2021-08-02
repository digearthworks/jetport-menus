<?php

namespace Database\Factories;

use Database\Factories\Concerns\GetsIcons;
use HeaderX\BukuIcons\Models\Icon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Turbine\Menus\Enums\MenuItemTargetEnum;
use App\Turbine\Menus\Enums\MenuItemTemplateEnum;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\Models\Menu;
use App\Turbine\Menus\Models\MenuItem;
use App\Turbine\Pages\Models\Page;

class MenuItemFactory extends Factory
{
    use GetsIcons;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->getItem();
    }

    public function getItem()
    {
        return [
            'type' => $this->faker->randomElement(Arr::except(MenuItemTypeEnum::toValues(), MenuItemTypeEnum::page_link()->value)),
            'template' => $this->faker->randomElement(MenuItemTemplateEnum::toValues()),
            'target' => $this->faker->randomElement(MenuItemTargetEnum::toValues()),
            'route' => null,
            'name' => $this->faker->unique()->word(),
            'uri' => $this->faker->word(),
            'handle' => $this->faker->unique()->word(),
            'active' => $this->faker->randomElement([1, 0]),
            'menu_id' => $this->faker->randomElement(Menu::all()->pluck('id')),
            'parent_id' => $this->faker->randomElement(MenuItem::all()->pluck('id')),
            'icon_id' => (Icon::firstOrCreate([
                'name' => $this->faker->randomElement($this->getIcons()),
            ], [
                'name' => $this->faker->randomElement($this->getIcons()),
            ]))->id,
        ];
    }

    public function getPageLink()
    {
        return [
            'type' => MenuItemTypeEnum::page_link(),
            'page_id' => $this->faker->randomElement(Page::all()->pluck('id')),
            'template' => $this->faker->randomElement(MenuItemTemplateEnum::toValues()),
            'target' => $this->faker->randomElement(MenuItemTargetEnum::toValues()),
            'route' => null,
            'uri' => $this->faker->word(),
            'name' => $this->faker->word(),
            'handle' => $this->faker->word(),
            'active' => $this->faker->randomElement([1, 0]),
            'menu_id' => $this->faker->randomElement(Menu::all()->pluck('id')),
            'parent_id' => $this->faker->randomElement(MenuItem::all()->pluck('id')),
            'icon_id' => Icon::firstOrCreate([
                'class' => $this->faker->randomElement($this->getIcons()),
            ], [
                'class' => $this->faker->randomElement($this->getIcons()),
                'source' => 'FontAwesome',
                'version' => config('fontawesome.version'),
            ]),
        ];
    }

    public function pageLink()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MenuItemTypeEnum::page_link(),
                'page_id' => $this->faker->randomElement(Page::all()->pluck('id')),
            ];
        });
    }

    public function InternalLink()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MenuItemTypeEnum::internal_link(),
            ];
        });
    }

    public function externalLink()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MenuItemTypeEnum::external_link(),
            ];
        });
    }

    public function InternalIframe()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MenuItemTypeEnum::internal_iframe(),
            ];
        });
    }

    public function externalIframe()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MenuItemTypeEnum::external_iframe(),
            ];
        });
    }

    public function dropdownLink()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MenuItemTypeEnum::dropdown_link(),
            ];
        });
    }

    public function menuLink()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MenuItemTypeEnum::menu_link(),
            ];
        });
    }

    public function deleted()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => now(),
            ];
        });
    }

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => false,
            ];
        });
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => true,
            ];
        });
    }
}
