<?php

use Illuminate\Support\Facades\Route;

//Main page
Route::get('/', function () {
    return view('home.index');
})->name('home');

//Card
Route::get('/cards', [App\Http\Controllers\CardController::class, 'index'])->name('cards');
Route::post('/card/create', [App\Http\Controllers\CardController::class, 'create'])->name('card.create');

//Pet
Route::get('/pet/{id}/show', [App\Http\Controllers\PetController::class, 'show'])->name('pet.show')->where(
    'id',
    '[0-9]+'
);
Route::post('/pet/add', [App\Http\Controllers\PetController::class, 'add'])->name('pet.add');

//Owner
Route::get('/owner/{id}/show', [App\Http\Controllers\OwnerController::class, 'show'])->name('owner.show')->where(
    'id',
    '[0-9]+'
);

//Visit
Route::get('/visits', [App\Http\Controllers\VisitController::class, 'index'])->name('visits');
Route::post('/visit/create', [App\Http\Controllers\VisitController::class, 'create'])->name('visit.create');
Route::get('/visit/{id}/edit', [App\Http\Controllers\VisitController::class, 'edit'])->name('visit.edit')->where(
    'id',
    '[0-9]+'
);
Route::post('/visit/update', [App\Http\Controllers\VisitController::class, 'update'])->name('visit.update');

//Notes
Route::get('/notes', [App\Http\Controllers\NoteController::class, 'index'])->name('notes');
Route::post('/note/create', [App\Http\Controllers\NoteController::class, 'create'])->name('note.create');
Route::get('/note/{id}/delete', [App\Http\Controllers\NoteController::class, 'delete'])->name('note.delete')->where(
    'id',
    '[0-9]+'
);

