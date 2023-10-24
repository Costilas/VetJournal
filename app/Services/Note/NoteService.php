<?php

namespace App\Services\Note;

use App\Http\Requests\Note\CreateNoteRequest;
use App\Models\Note;

class NoteService
{
    public function getPaginatedNotes(int $limit)
    {
        return Note::paginate($limit);
    }

    public function createNewNote(CreateNoteRequest $request)
    {
        return Note::create($request->validated());
    }

    public function deleteExistingNote(int $id): ?bool
    {
        $note = Note::findOrFail($id);

        return $note?->delete();
    }
}
