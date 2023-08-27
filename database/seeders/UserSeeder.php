<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'kuzmin@mail.com',
            'is_active' => 1,
            'is_admin' => 1,
            'is_dev' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // password
            'remember_token' => '',
        ]);

        User::create([
            'name' => 'Евгения',
            'patronymic' => 'Сергеевна',
            'last_name' => 'Кузьмина',
            'email' => 'kuzmina@mail.com',
            'is_active' => 1,
            'is_admin' => 1,
            'is_dev' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // password
            'remember_token' => '',
        ]);

        User::create([
            'name' => 'Людмила',
            'patronymic' => 'Александровна',
            'last_name' => 'Романова',
            'email' => 'romanova@mail.com',
            'is_active' => 1,
            'is_admin' => 0,
            'is_dev' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // password
            'remember_token' => '',
        ]);
    }
}
