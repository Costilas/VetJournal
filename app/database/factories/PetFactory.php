<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pet_name' => $this->faker->firstName(),
            'owner_id' => $this->faker->numberBetween(1, 10),
            'kind_id' => $this->faker->numberBetween(1, 7),
            'gender_id' => $this->faker->numberBetween(1, 2),
            'birth' => $this->faker->date(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
