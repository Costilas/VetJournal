<?php

use Illuminate\Support\Facades\Route;

//Main page
Route::get('/', function () { return view('home.index'); })->name('home');

//Card
Route::get('/search', [\App\Http\Controllers\CardController::class, 'index'])->name('search');
Route::post('/card/create', [\App\Http\Controllers\CardController::class, 'create'])->name('card.create');

//Pet
Route::get('/pet/{id}/show', [\App\Http\Controllers\PetController::class, 'show'])->name('pet.show');
Route::post('/pet/add', [\App\Http\Controllers\PetController::class, 'add'])->name('pet.add');
//Owner
Route::get('/owner/{id}/show', [\App\Http\Controllers\OwnerController::class, 'show'])->name('owner.show');

//Visit
Route::post('/visit/create', [\App\Http\Controllers\VisitController::class, 'create'])->name('visit.create');
Route::get('/visit/{id}/edit', [\App\Http\Controllers\VisitController::class, 'edit'])->name('visit.edit');
Route::post('/visit/update', [\App\Http\Controllers\VisitController::class, 'update'])->name('visit.update');
