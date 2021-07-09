<?php

namespace Database\Factories;

use Database\Factories\Concerns\GetsIcons;
use HeaderX\BukuIcons\Models\Icon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Turbine\Menus\Enums\MenuTemplateEnum;
use Turbine\Menus\Enums\MenuTypeEnum;
use Turbine\Menus\Models\Menu;

class MenuFactory extends Factory
{
    use GetsIcons;

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
        return [
            'name' => $this->faker->word(),
            'handle' => $this->faker->word(),
            'type' => $this->faker->randomElement(MenuTypeEnum::toValues()),
            'template' => $this->faker->randomElement(MenuTemplateEnum::toValues()),
            'active' => rand(0, 1),
            'icon_id' => (Icon::firstOrCreate([
                'name' => $this->faker->randomElement($this->getIcons()),
            ], [
                'name' => $this->faker->randomElement($this->getIcons()),
            ]))->id,
        ];
    }

    public function deleted()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => now(),
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

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => false,
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => $this->faker->randomElement(MenuTypeEnum::admin()),
            ];
        });
    }

    public function user()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => $this->faker->randomElement(MenuTypeEnum::user()),
            ];
        });
    }

    public function guest()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => $this->faker->randomElement(MenuTypeEnum::user()),
            ];
        });
    }
}
