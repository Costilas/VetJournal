<?php

namespace Database\Seeders;

use App\Models\Owner;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::factory()->count(10)->create();
    }

}
