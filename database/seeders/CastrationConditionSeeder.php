<?php

namespace Database\Seeders;

use App\Models\CastrationCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CastrationConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CastrationCondition::create(['condition'=>'Да', 'icon'=>'<i class="bi bi-check-circle text-success"></i>']);
        CastrationCondition::create(['condition'=>'Нет', 'icon'=>'<i class="bi bi-x-circle text-danger"></i>']);
        CastrationCondition::create(['condition'=>'Неизвестно', 'icon'=>'<i class="bi bi-recycle text-warning"></i>']);
    }
}
