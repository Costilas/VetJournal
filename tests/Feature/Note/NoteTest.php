<?php

use App\Models\Note;

test('User can create note', function (){

    $this->seed(\Database\Seeders\StatusSeeder::class);

    $response = asUser(true)->post('/note/create', [
        'status_id' => 1,
        'theme' => 'test theme',
        'body' => 'test body',
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('notes', [
        'status_id' => 1,
        'theme' => 'test theme',
        'body' => 'test body',
    ]);
    $this->assertDatabaseCount('notes', 1);
});

test('User can delete note', function (){

    $note = Note::create([
        'status_id' => '1',
        'theme' => 'test theme',
        'body' => 'test body',
    ]);

    $this->assertModelExists($note);

    asUser(true)->get("note/$note->id/delete");

    $this->assertModelMissing($note);
});
