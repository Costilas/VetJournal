<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

function asUser(bool $followRedirects = false): TestCase
{
    $user = User::create([
        'email' => 'user@mail.com',
        'password' => Hash::make('123'),
        'name' => '1',
        'last_name' => '1',
        'patronymic' => '1',
    ]);

    $return = test();

    if($followRedirects) {
        $return->followingRedirects();
    }

    return $return->actingAs($user);
}

function asAdmin(bool $followRedirects = false): TestCase
{
    $user = User::create([
        'email' => 'admin@mail.com',
        'password' => Hash::make('123'),
        'name' => '1',
        'last_name' => '1',
        'patronymic' => '1',
        'is_admin' => '1'
    ]);

    $return = test();

    if($followRedirects) {
        $return->followingRedirects();
    }

    return $return->actingAs($user);
}

function getTestPhone(): string
{
    $country = config('global.clinic_country');
    $phones = [
        'RU' => '8(999)888-77-66',
        'RS' => '+381652625321'
    ];

    return $phones[$country];
}

function getNewUser(): User
{
    return User::create([
        'email' => 'new@mail.com',
        'password' => Hash::make('123'),
        'name' => '1',
        'last_name' => '1',
        'patronymic' => '1',
    ]);
}
