<?php

use Illuminate\Support\Facades\Route;

//Login
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'auth'])->name('auth');

//Authorized
Route::group(['middleware' => 'auth'], function () {
    //Notes
    Route::controller(App\Http\Controllers\NoteController::class)->group(function () {
        Route::get('/', 'index')->name('notes');
        Route::get('/note/{id}/delete', 'delete')->name('note.delete')->where('id', '[0-9]+');
        Route::post('/note/create', 'create')->name('note.create');
    });

    //Pet
    Route::controller(App\Http\Controllers\PetController::class)->group(function () {
        Route::group(['prefix' => 'pets'], function () {
            Route::get('/{id}/show', 'show')->name('pets.show')->where('id', '[0-9]+');
            Route::get('/{id}/edit', 'edit')->name('pets.edit')->where('id', '[0-9]+');
            Route::get('/{id}/visit/search', 'searchVisits')->name('pets.visit.search')->where('id', '[0-9]+');
            Route::post('/{id}/update', 'update')->name('pets.update')->where('id', '[0-9]+');
        });
    });

    //Owner
    Route::controller(App\Http\Controllers\OwnerController::class)->group(function () {
        Route::group(['prefix' => 'owners'], function () {
            Route::get('/','index')->name('owners');
            Route::get('/{id}/show', 'show')->name('owners.show')->where('id', '[0-9]+');
            Route::get('/search', 'search')->name('owners.search');
            Route::post('/store', 'store')->name('owners.store');
            Route::post('/{id}/update', 'update')->name('owners.update')->where('id', '[0-9]+');
            Route::post('/{id}/attach', 'attach')->name('owners.attach.pet')->where('id', '[0-9]+');
        });
    });

    //Visit
    Route::controller(App\Http\Controllers\VisitController::class)->group(function () {
        Route::get('/visits', 'index')->name('visits');
        Route::get('/visits/search', 'search')->name('visits.search');
        Route::get('/visit/{id}/edit', 'edit')->name('visit.edit')->where('id', '[0-9]+');
        Route::post('/visit/create', 'create')->name('visit.create');
        Route::post('/visit/{id}/update', 'update')->name('visit.update')->where('id', '[0-9]+');
    });

    //Control Area
    Route::controller(App\Http\Controllers\ControlController::class)->group(function () {
        Route::get('/control', 'index')->name('control');
    });

    //Logout
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});

//Management
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::controller(App\Http\Controllers\UserController::class)->group(function () {
        Route::get('/users', 'index')->name('admin.users');
        Route::get('/users/filter', 'search')->name('admin.users.filtrate');

        //Create users
        Route::get('/user/register', 'create')->name('admin.user.register');
        Route::post('/user/register', 'store')->name('admin.user.store');

        //Edit users
        Route::get('/user/{targetUser}/edit', 'edit')->name('admin.user.edit')->where('user', '[0-9]+');
        Route::post('/user/{targetUser}/update', 'update')->name('admin.user.update')->where('user', '[0-9]+');
        Route::post('/user/{targetUser}/password/change', 'passwordChange')->name('admin.user.password')->where('user', '[0-9]+');
        Route::post('/user/{targetUser}/login/change', 'loginChange')->name('admin.user.login')->where('user', '[0-9]+');

        //Activate/Deactivate users
        Route::get('/user/{targetUser}/deactivate', 'deactivate')->name('admin.user.deactivate')->where('user', '[0-9]+');
        Route::get('/user/{targetUser}/activate', 'activate')->name('admin.user.activate')->where('user', '[0-9]+');

        //Promotions
        Route::get('/user/{targetUser}/promote', 'promote')->name('admin.user.promote')->where('user', '[0-9]+');
        Route::get('/user/{targetUser}/demote', 'demote')->name('admin.user.demote')->where('user', '[0-9]+');
    });
});


