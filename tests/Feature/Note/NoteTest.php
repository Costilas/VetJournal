<?php

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('User can create note', function (){

    $this->seed(\Database\Seeders\StatusSeeder::class);

    $user = User::create([
        'email' => 'test@mail.com',
        'password' => Hash::make('123'),
        'name' => '1',
        'last_name' => '1',
        'patronymic' => '1',
        'is_active' => '1',
    ]);

    $this->followingRedirects()->actingAs($user)->post('/note/create', [
        'status_id' => '1',
        'theme' => 'test theme',
        'body' => 'test body',
    ]);

    $this->assertDatabaseHas('notes', [
        'status_id' => 1,
        'theme' => 'test theme',
        'body' => 'test body',
    ]);
    $this->assertDatabaseCount('notes', 1);
});

test('User can delete note', function (){
    $user = User::create([
        'email' => 'test@mail.com',
        'password' => Hash::make('123'),
        'name' => '1',
        'last_name' => '1',
        'patronymic' => '1',
    ]);

    $note = Note::create([
        'status_id' => '1',
        'theme' => 'test theme',
        'body' => 'test body',
    ]);

    $this->followingRedirects()->actingAs($user)->get("note/$note->id/delete");

    $this->assertModelMissing($note);
});
