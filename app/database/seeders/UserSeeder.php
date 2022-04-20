<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Сергей',
            'patronymic' => 'Сергеевич',
            'last_name' => 'Кузьмин',
            'email' => 'reactorr@mail.ru',
            'is_active' => 1,
            'is_admin' => 1,
            'is_dev' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$fLJU9s7BP1wth1EANlkntuqPLVUjtJ46wSN78KT1UIWEdRXRoGKAm', // password
            'remember_token' => '',
        ]);
    }
}
