<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    protected $model = Visit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pet_id' => Pet::factory(),
            'user_id' => User::factory(),
            'visit_date' => Carbon::now()->format('Y-m-d'),
            'weight' => $this->faker->numberBetween(1000, 8000),
            'temperature' => $this->faker->numberBetween(370, 395),
            'pre_diagnosis' => $this->faker->sentence,
            'visit_info' => $this->faker->paragraph,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'treatment' => $this->faker->text(100),
        ];
    }
}
