<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Turbine\Auth\Enums\UserTypeEnum;
use App\Turbine\Auth\Models\Role;

/**
 * Class RoleFactory.
 */
class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(UserTypeEnum::toValues()),
            'name' => $this->faker->word,
        ];
    }
}
