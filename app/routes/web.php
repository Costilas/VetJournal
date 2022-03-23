<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/owner/{id}/show', 'App\Http\Controllers\OwnerController@show')->name('owner.show');




/*//Visits
Route::get('/visits', 'App\Http\Controllers\VisitController@index')->name('visits');
Route::get('/visit/add', 'App\Http\Controllers\VisitController@index')->name('visit.add');
Route::get('/visit/{id}/show', 'App\Http\Controllers\VisitController@single')->name('visit.show');
Route::get('/visit/{id}/update', 'App\Http\Controllers\VisitController@update')->name('visit.update');
Route::get('/visit/{id}/delete', 'App\Http\Controllers\VisitController@delete')->name('visit.delete');*/

//Notes
/*Route::get('/notes', 'NoteController@index')->name('notes');
Route::get('/note/create', 'NoteController@index')->name('note.create');
Route::get('/note/{id}/show', 'NoteController@single')->name('note.show');
Route::get('/note/{id}/update', 'NoteController@update')->name('note.update');
Route::get('/note/{id}/delete', 'NoteController@delete')->name('note.delete');*/

/*
Route::get('/login', 'UserController@index')->name('user.login');*/

