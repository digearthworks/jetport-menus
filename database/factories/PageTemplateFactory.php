<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turbine\Pages\Models\Page;
use Turbine\Pages\Models\PageTemplate;

class PageTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PageTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(3),
            'html' => $this->faker->randomHtml(),
            'css' => $this->faker->randomElement(['*{ color : red; }', '*{ color : blue; }', '*{ color : green; }']),
        ];
    }
}
