<?php

namespace Database\Factories;

use App\Turbine\Menus\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternalLinkFactory extends Factory
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
        return MenuItem::factory()->internalLink();
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
