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
        $rootEmail = config('global.root_user.email');
        $rootPassword = Hash::make(config('global.root_user.password'));

        User::create([
            'name' => 'root',
            'patronymic' => 'root',
            'last_name' => 'root',
            'email' => $rootEmail,
            'is_active' => 1,
            'is_admin' => 1,
            'is_dev' => 1,
            'email_verified_at' => now(),
            'password' => $rootPassword, // password
            'remember_token' => '',
        ]);
    }
}
