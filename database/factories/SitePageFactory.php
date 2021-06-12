<?php

namespace Database\Factories;

use App\Models\SitePage;
use Illuminate\Database\Eloquent\Factories\Factory;

class SitePageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SitePage::class;

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
            'body' => $this->faker->randomHtml(),
            'layout' => $this->faker->randomElement(['layouts.guest', 'layouts.welcome']),
            'active' => 1,
        ];
    }
}
