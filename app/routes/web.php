<?php

use Illuminate\Support\Facades\Route;


//Unauthorized user
//Login
Route::get('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\UserController::class, 'auth'])->name('auth');

//Authorized user
Route::group(['middleware'=>'auth'], function (){
//Notes
    Route::get('/', [App\Http\Controllers\NoteController::class, 'index'])->name('notes');
    Route::post('/note/create', [App\Http\Controllers\NoteController::class, 'create'])->name('note.create');
    Route::get('/note/{id}/delete', [App\Http\Controllers\NoteController::class, 'delete'])->name('note.delete')->where('id', '[0-9]+');
//Card
    Route::get('/cards', [App\Http\Controllers\CardController::class, 'index'])->name('cards');
    Route::post('/card/create', [App\Http\Controllers\CardController::class, 'create'])->name('card.create');
//Pet
    Route::get('/pet/{id}/show', [App\Http\Controllers\PetController::class, 'show'])->name('pet.show')->where('id', '[0-9]+');
    Route::post('/pet/add', [App\Http\Controllers\PetController::class, 'add'])->name('pet.add');
//Owner
    Route::get('/owner/{id}/show', [App\Http\Controllers\OwnerController::class, 'show'])->name('owner.show')->where('id', '[0-9]+');
//Visit
    Route::get('/visits', [App\Http\Controllers\VisitController::class, 'index'])->name('visits');
    Route::post('/visit/create', [App\Http\Controllers\VisitController::class, 'create'])->name('visit.create');
    Route::get('/visit/{id}/edit', [App\Http\Controllers\VisitController::class, 'edit'])->name('visit.edit')->where('id', '[0-9]+');
    Route::post('/visit/update', [App\Http\Controllers\VisitController::class, 'update'])->name('visit.update');
//Logout
    Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
});

//Authorized and Admin access
//Management
Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function (){
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users');
    Route::get('/user/register', [App\Http\Controllers\UserController::class, 'create'])->name('admin.user.register');
    Route::post('/user/register', [App\Http\Controllers\UserController::class, 'store'])->name('admin.user.store');
    Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.user.edit')->where('id', '[0-9]+');
    Route::get('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');
    Route::get('/user/{id}/deactivate', [App\Http\Controllers\UserController::class, 'deactivate'])->name('admin.user.deactivate')->where('id', '[0-9]+');
    Route::get('/user/{id}/restore', [App\Http\Controllers\UserController::class, 'restore'])->name('admin.user.restore')->where('id', '[0-9]+');
    Route::post('/user/{id}/password', [App\Http\Controllers\UserController::class, 'passwordChange'])->name('admin.user.password')->where('id', '[0-9]+');
    Route::post('/user/{id}/login', [App\Http\Controllers\UserController::class, 'loginChange'])->name('admin.user.login')->where('id', '[0-9]+');
});


