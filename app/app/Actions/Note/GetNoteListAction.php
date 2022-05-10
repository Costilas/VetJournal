<?php

namespace App\Actions\Note;

use App\Models\Note;

class GetNoteListAction
{
    public function __invoke()
    {
       return view('notes.index', [
           'notes' => Note::with('status')
               ->latest()
               ->paginate(10)
       ]);
    }
}
