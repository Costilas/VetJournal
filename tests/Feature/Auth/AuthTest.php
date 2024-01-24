<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;


test('Guest redirected to login page', function () {
    $response = $this->followingRedirects()->get('/');

    $response->assertStatus(200);
    $response->assertSee('Добро пожаловать в VetJournal!');
});

test('Registered user successfully can login', function () {
    $user = User::create([
        'email' => 'test@mail.com',
        'password' => Hash::make('123'),
        'name' => '1',
        'last_name' => '1',
        'patronymic' => '1',
    ]);

    $response = $this->followingRedirects()->post('/login', [
        'email' => $user->email,
        'password' => '123'
    ]);

    $response->assertStatus(200);
    $response->assertSee('Вы вошли как: test@mail.com');
    $this->assertAuthenticatedAs($user, 'web');
});

test('Inactive user cannot auth', function () {
    $user = User::create([
        'email' => 'test@mail.com',
        'password' => Hash::make('123'),
        'name' => '1',
        'last_name' => '1',
        'patronymic' => '1',
        'is_active' => '0',
    ]);

    $response = $this->followingRedirects()->post('/login', [
        'email' => 'dev@mail.com',
        'password' => '123'
    ]);

    $response->assertStatus(200);
    $this->assertGuest('web');
    $response->assertSee('Данные неверны или ваш профиль заблокирован');
});

test('Unregistered user redirected to login page', function () {

    $response = $this->followingRedirects()->post('/login', [
        'email' => 'dev@mail.com',
        'password' => '123'
    ]);

    $response->assertStatus(200);
    $this->assertGuest('web');
    $response->assertSee('Данные неверны или ваш профиль заблокирован');
});

test('Authenticated user can successfully logout', function () {
    $user = User::create([
        'email' => 'test@mail.com',
        'password' => Hash::make('123'),
        'name' => '1',
        'last_name' => '1',
        'patronymic' => '1',
    ]);

    $response = $this->followingRedirects()->actingAs($user)->post('/login', [
        'email' => $user->email,
        'password' => '123'
    ]);

    $response->assertStatus(200);
    $response->assertSee('Вы вошли как: test@mail.com');
    $this->assertAuthenticatedAs($user, 'web');

    $response = $this->followingRedirects()->actingAs($user)->get('/logout');

    $response->assertStatus(200);
    $response->assertSee('Добро пожаловать в VetJournal!');
});

