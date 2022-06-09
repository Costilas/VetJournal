<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Status;
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
            UserSeeder::class,
            KindSeeder::class,
            GenderSeeder::class,
            StatusSeeder::class,
            CastrationConditionSeeder::class,
        ]);

       $this->call([
            CreateProjectRoles::class,
        ]);
    }
}
