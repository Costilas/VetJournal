<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('Notes: guest redirected to login page from note routes', function (string $method, string $route) {
    $response = $this->$method($route);

    $response->assertStatus(302);
    $response->assertRedirect('/login');
})->with([
    ['get', '/'],
    ['get', '/note/1/delete'],
    ['post', '/note/create'],
]);

test('Pets: guest redirected to login page from pets routes', function (string $method, string $route) {
    $response = $this->$method($route);

    $response->assertStatus(302);
    $response->assertRedirect('/login');
})->with([
    ['get', 'pets/1/show'],
    ['get', 'pets/1/edit'],
    ['get', 'pets/1/visit/search'],
    ['post', 'pets/1/update'],
]);

test('Owners: guest redirected to login page from owner routes', function (string $method, string $route) {
    $response = $this->$method($route);

    $response->assertStatus(302);
    $response->assertRedirect('/login');
})->with([
    ['get', 'owners'],
    ['get', 'owners/1/show'],
    ['get', 'owners/search'],
    ['post', 'owners/store'],
    ['post', 'owners/1/update'],
    ['post', 'owners/1/attach'],
]);

test('Visits: guest redirected to login page from visit routes', function (string $method, string $route) {
    $response = $this->$method($route);

    $response->assertStatus(302);
    $response->assertRedirect('/login');
})->with([
    ['get', 'visits'],
    ['get', 'visits/search'],
    ['get', 'visits/1/edit'],
    ['post', 'visits/create'],
    ['post', 'visits/1/update'],
]);

test('Control: guest redirected to login page from control routes', function (string $method, string $route) {
    $response = $this->$method($route);

    $response->assertStatus(302);
    $response->assertRedirect('/login');
})->with([
    ['get', 'control'],
]);

test('Admin area: guest cannot access routes', function (string $method, string $route) {
    $response = $this->$method($route);

    $response->assertStatus(404);
})->with([
    ['get', 'admin/users'],
    ['get', 'admin/filter'],
    ['get', 'admin/user/register'],
    ['post', 'admin/user/register'],
    ['get', 'admin/user/1/edit'],
    ['post', 'admin/user/1/update'],
    ['post', 'admin/user/1/password/change'],
    ['post', 'admin/user/1/login/change'],
    ['get', 'admin/user/1/deactivate'],
    ['get', 'admin/user/1/activate'],
    ['get', 'admin/user/1/promote'],
    ['get', 'admin/user/1/demote'],
]);

test('Admin area: non-admin user cannot access routes', function (string $method, string $route) {

    $response = asUser()->$method($route);

    $response->assertStatus(404);

})->with([
    ['get', 'admin/users'],
    ['get', 'admin/filter'],
    ['get', 'admin/user/register'],
    ['post', 'admin/user/register'],
    ['get', 'admin/user/1/edit'],
    ['post', 'admin/user/1/update'],
    ['post', 'admin/user/1/password/change'],
    ['post', 'admin/user/1/login/change'],
    ['get', 'admin/user/1/deactivate'],
    ['get', 'admin/user/1/activate'],
    ['get', 'admin/user/1/promote'],
    ['get', 'admin/user/1/demote'],
]);
