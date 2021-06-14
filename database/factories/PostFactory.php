<?php

namespace Database\Factories;

use App\Auth\Models\User;
use App\Pages\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'body' => $this->faker->sentence,
            'user_id' => $this->faker->randomElement(array_merge(User::all()->pluck('id')->toArray() ?? [null], [null])),
        ];
    }
}
