<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;


test('Guest redirected to login page', function () {
    $response = $this->followingRedirects()->get('/');

    $response->assertStatus(200);
    $response->assertSee(__('auth.view.welcome'));
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

    $goalSuccessMessage = __('header.view.logged_as') . ' ' . $user->email;
    $response->assertStatus(200);
    $response->assertSee($goalSuccessMessage);
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
    $response->assertSee(__('auth.notifications.login.failed'));
});

test('Unregistered user redirected to login page', function () {

    $response = $this->followingRedirects()->post('/login', [
        'email' => 'dev@mail.com',
        'password' => '123'
    ]);

    $response->assertStatus(200);
    $this->assertGuest('web');
    $response->assertSee(__('auth.notifications.login.failed'));
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

    $goalSuccessMessage = __('header.view.logged_as') . ' ' . $user->email;

    $response->assertStatus(200);
    $response->assertSee($goalSuccessMessage);
    $this->assertAuthenticatedAs($user, 'web');

    $response = $this->followingRedirects()->actingAs($user)->get('/logout');

    $response->assertStatus(200);
    $response->assertSee(__('auth.view.welcome'));
});

