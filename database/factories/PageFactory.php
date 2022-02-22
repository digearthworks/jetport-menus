<?php

namespace Database\Factories;

use App\Turbine\Pages\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

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
