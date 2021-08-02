<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Turbine\Pages\Models\Page;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug(2),
            'title' => $this->faker->unique()->sentence(3),
            'html' => $this->faker->randomHtml(),
            'css' => $this->faker->randomElement(['*{ color : red; }', '*{ color : blue; }', '*{ color : green; }']),
            'layout' => $this->faker->randomElement(['layouts.guest']),
            'active' => 1,
        ];
    }
}
