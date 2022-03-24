<?php

use Illuminate\Support\Facades\Route;

//Main page
Route::get('/', function () {
    return view('home.index');
})->name('home');

//Card.Search
Route::get('/search', 'App\Http\Controllers\CardController@index')->name('search');
//Card.Create
Route::post('/card/create', 'App\Http\Controllers\CardController@create')->name('card.create');

//Pet.show - Single
Route::get('/pet/{id}/show', 'App\Http\Controllers\PetController@show')->name('pet.show');
//Owner.show - Single
Route::get('/owner/{id}/show', [\App\Http\Controllers\OwnerController::class, 'show'])->name('owner.show');

//Visit.create
Route::post('/visit/create', [\App\Http\Controllers\VisitController::class, 'create'])->name('visit.create');
