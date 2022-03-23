<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pet_id' => $this->faker->numberBetween(1, 30),
            'visit_date' => $this->faker->date(),
            'weight' => $this->faker->numberBetween(1, 30),
            'pre_diagnosis' => $this->faker->text(100),
            'visit_info' => $this->faker->text(1000),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
