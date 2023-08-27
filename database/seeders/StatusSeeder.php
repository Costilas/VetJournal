<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name'=>'Рутина', 'class_name'=>'low']);
        Status::create(['name'=>'Внимание', 'class_name'=>'medium']);
        Status::create(['name'=>'Важно', 'class_name'=>'high']);
        Status::create(['name'=>'Срочно', 'class_name'=>'critical']);
    }
}
