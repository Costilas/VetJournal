<?php

use Illuminate\Support\Facades\Route;

//Login
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'auth'])->name('auth');

//Authorized
Route::group(['middleware' => 'auth'], function () {
    //Notes
    Route::get('/', [App\Http\Controllers\NoteController::class, 'index'])->name('notes');
    Route::post('/note/create', [App\Http\Controllers\NoteController::class, 'create'])->name('note.create');
    Route::get('/note/{id}/delete', [App\Http\Controllers\NoteController::class, 'delete'])->name('note.delete')->where(
        'id',
        '[0-9]+');
    //Card
    Route::get('/cards', [App\Http\Controllers\CardController::class, 'index'])->name('cards');
    Route::get('/card/search', [App\Http\Controllers\CardController::class, 'search'])->name('card.search');
    Route::post('/card/store', [App\Http\Controllers\CardController::class, 'store'])->name('card.store');
    //Pet
    Route::get('/pet/{pet}/show', [App\Http\Controllers\PetController::class, 'show'])->name('pet.show')->where(
        'pet',
        '[0-9]+'
    );
    Route::post('/pet/add', [App\Http\Controllers\PetController::class, 'add'])->name('pet.add');
    Route::get('/pet/{pet}/edit', [App\Http\Controllers\PetController::class, 'edit'])->name('pet.edit')->where(
        'pet',
        '[0-9]+'
    );
    Route::post('/pet/{pet}/update', [App\Http\Controllers\PetController::class, 'update'])->name('pet.update')->where(
        'pet',
        '[0-9]+'
    );
    Route::get('/{pet}/visit/search', [App\Http\Controllers\PetController::class, 'searchVisits'])->name('pet.visit.search');
    //Owner
    Route::get('/owner/{owner}/show', [App\Http\Controllers\OwnerController::class, 'show'])->name('owner.show')->where(
        'owner',
        '[0-9]+'
    );
    Route::post('/owner/{owner}/update', [App\Http\Controllers\OwnerController::class, 'update'])->name(
        'owner.update'
    )->where('owner', '[0-9]+');
    //Visit
    Route::get('/visits', [App\Http\Controllers\VisitController::class, 'index'])->name('visits');
    Route::get('/visits/search', [App\Http\Controllers\VisitController::class, 'search'])->name('visits.search');
    Route::post('/visit/create', [App\Http\Controllers\VisitController::class, 'create'])->name('visit.create');
    Route::get('/visit/{id}/edit', [App\Http\Controllers\VisitController::class, 'edit'])->name('visit.edit')->where(
        'id',
        '[0-9]+'
    );
    Route::post('/visit/{id}/update', [App\Http\Controllers\VisitController::class, 'update'])->name(
        'visit.update'
    )->where('id', '[0-9]+');
    //Logout
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});

//Authorized and Admin access
//Management
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])
        ->name('admin.users');
    Route::get('/user/register', [App\Http\Controllers\UserController::class, 'create'])
        ->name('admin.user.register');
    Route::post('/user/register', [App\Http\Controllers\UserController::class, 'store'])->name('admin.user.store');
    Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.user.edit')->where(
        'id',
        '[0-9]+'
    );
    Route::post('/user/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name(
        'admin.user.update'
    )->where('id', '[0-9]+');
    Route::get('/user/{id}/deactivate', [App\Http\Controllers\UserController::class, 'deactivate'])->name(
        'admin.user.deactivate'
    )->where('id', '[0-9]+');
    Route::get('/user/{id}/activate', [App\Http\Controllers\UserController::class, 'activate'])->name(
        'admin.user.activate'
    )->where('id', '[0-9]+');
    Route::post('/user/{id}/password/change', [App\Http\Controllers\UserController::class, 'passwordChange'])->name(
        'admin.user.password'
    )->where('id', '[0-9]+');
    Route::post('/user/{id}/login/change', [App\Http\Controllers\UserController::class, 'loginChange'])->name(
        'admin.user.login'
    )->where('id', '[0-9]+');
    Route::get('/user/{id}/promote', [App\Http\Controllers\UserController::class, 'promoteAdmin'])->name(
        'admin.user.promote'
    )->where('id', '[0-9]+');
    Route::get('/user/{id}/demote', [App\Http\Controllers\UserController::class, 'demoteAdmin'])->name(
        'admin.user.demote'
    )->where('id', '[0-9]+');
});


