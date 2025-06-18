<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Owner>
 */
class OwnerFactory extends Factory
{
    protected $model = Owner::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'patronymic' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->numerify('89#########'),
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'additional_phone' => $this->faker->optional()->numerify('89#########'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
