<?php

namespace Database\Factories;

use App\Icons\Models\Icon;
use App\Menus\Enums\MenuGroup;
use App\Menus\Enums\MenuItemGroup;
use App\Menus\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return $this->faker->randomElement([$this->getParent(), $this->getItem()]);
    }

    public function getIcons()
    {
        return [
            'fab fa-blogger',
            'far fa-plus-square',
            'far fa-eye',
            'fas fa-piggy-bank',
            'far fa-list-alt',
            'fas fa-info-circle',
            'fas fa-edit',
            'fas fa-plus-square',
            'fas fa-barcode',
            'fas fa-calculator',
            'fas fa-file-invoice',
            'fas fa-money-check-alt',
            'fas fa-project-diagram',
            'fas fa-chart-line',
            'fas fa-business-time',
            'fas fa-address-book',
            'far fa-clock',
            'fas fa-user-clock',
            'fas fa-people-carry',
            'fas fa-balance-scale',
            'fas fa-chart-bar',
            'fas fa-table',
            'fas fa-drafting-compass',
            'fas fa-file-invoice-dollar',
            'fas fa-database',
            'fas fa-trash-alt',
            'fas fa-camera-retro',
            'fas fa-desktop',
            'fas fa-file-import',
            'fas fa-sticky-note',
            'fab fa-angellist',
            'fas fa-money-bill-wave',
            'fas fa-cogs',
            'fas fa-list',
            'fas fa-list-ol',
            'fab fa-researchgate',
            'fas fa-search',
            'fas fa-dumbbell',
            'fas fa-hourglass-start',
            'fas fa-home',
            'fas fa-laptop-code',
            'fab fa-internet-explorer',
            'fab fa-git',
        ];

    }

    public function getParent()
    {
        return [
            'group' => $this->faker->randomElement(MenuGroup::toValues()),
            'type' => $this->faker->randomElement(['internal_link', 'external_link', 'main_menu']),
            'name' => $this->faker->word(),
            'handle' => $this->faker->word(),
            'link' => $this->faker->word(),
            'active' => $this->faker->randomElement([1, 0]),
            'iframe' => $this->faker->randomElement([1, 0]),
            'sort' => $this->faker->randomNumber(),
            'row' => $this->faker->randomElement([1, 2, 3, 4]),
            'menu_id' => null,
            'icon_id' => Icon::firstOrCreate([
                'class' => $this->faker->randomElement($this->getIcons()),
            ], [
                'class' => $this->faker->randomElement($this->getIcons()),
                'source' => 'FontAwesome',
                'version' => '5',
            ]),
        ];
    }

    public function getItem()
    {
        return [
            'group' => $this->faker->randomElement(MenuItemGroup::toValues()),
            'type' => $this->faker->randomElement(['internal_link', 'external_link', 'main_menu']),
            'name' => $this->faker->word(),
            'handle' => $this->faker->word(),
            'link' => $this->faker->word(),
            'active' => $this->faker->randomElement([1, 0]),
            'iframe' => $this->faker->randomElement([1, 0]),
            'sort' => $this->faker->randomNumber(),
            'row' => $this->faker->randomElement([1, 2, 3, 4]),
            'menu_id' => $this->faker->randomElement(Menu::all()->pluck('id')),
            'icon_id' => Icon::firstOrCreate([
                'class' => $this->faker->randomElement($this->getIcons()),
            ], [
                'class' => $this->faker->randomElement($this->getIcons()),
                'source' => 'FontAwesome',
                'version' => '5',
            ]),
        ];
    }

    /**
     * @return MenuFactory
     */
    public function deleted()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => now(),
            ];
        });
    }

    /**
     * @return UserFactory
     */
    public function parent()
    {
        return $this->state(function (array $attributes) {
            return [
                'group' => $this->faker->randomElement(MenuGroup::toValues()),
                'menu_id' => null,
            ];
        });
    }

    /**
     * @return UserFactory
     */
    public function item()
    {
        return $this->state(function (array $attributes) {
            return [
                'group' => $this->faker->randomElement(MenuItemGroup::toValues()),
                'menu_id' => $this->faker->randomElement(Menu::all()->pluck('id')),
            ];
        });
    }

}
