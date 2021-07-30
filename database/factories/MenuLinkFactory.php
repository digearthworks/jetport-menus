<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Turbine\Menus\Models\MenuItem;

class MenuLinkFactory extends Factory
{
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
        return MenuItem::factory()->menuLink();
    }

    public function deleted()
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => now(),
            ];
        });
    }

    public function deactivated()
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
