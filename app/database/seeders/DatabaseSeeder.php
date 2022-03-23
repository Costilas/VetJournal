<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Visit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OwnerSeeder::class,
            PetSeeder::class,
            VisitSeeder::class
        ]);
    }
}
