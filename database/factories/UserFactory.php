<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName,
            'patronymic' => $this->faker->firstName,
            'name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'is_active' => true,
            'is_admin' => false,
            'is_dev' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
        ];
    }
}
