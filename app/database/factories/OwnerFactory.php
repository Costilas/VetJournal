<?php

namespace Database\Factories;

use Faker\Core\Number;
use Faker\Provider\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->firstName('female'),
            'patronymic'=>$this->faker->middleName('female'),
            'last_name'=>$this->faker->lastName(),
            'phone'=> $this->faker->isbn10(),
            'address' => $this->faker->city(),
            'created_at'=> $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
