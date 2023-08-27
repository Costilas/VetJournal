<?php

namespace Database\Seeders;

use App\Models\Kind;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kind::create(['kind'=>'Кошка']);
        Kind::create(['kind'=>'Собака']);
        Kind::create(['kind'=>'Птица']);
        Kind::create(['kind'=>'Хорек']);
        Kind::create(['kind'=>'Кролик']);
        Kind::create(['kind'=>'Лиса']);
        Kind::create(['kind'=>'Рептилия']);
        Kind::create(['kind'=>'Грызун']);
    }
}
