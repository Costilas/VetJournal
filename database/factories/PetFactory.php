<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pet_name' => $this->faker->firstName,
            'owner_id' => Owner::factory(),
            'kind_id' => 1,
            'gender_id' => 1,
            'castration_condition_id' => 1,
            'birth' => $this->faker->dateTimeBetween('-3 years', '-2 months')->format('Y-m-d H:i:s'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
