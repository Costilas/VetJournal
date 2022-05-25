<?php

namespace App\Http\Controllers;

use App\Actions\Note\CreateNoteAction;
use App\Actions\Note\DeleteNoteAction;
use App\Actions\Note\GetNoteListAction;
use App\Http\Requests\Note\CreateRequest;

class NoteController extends Controller
{
    public function index(GetNoteListAction $getNoteListAction)
    {
        return view('notes.index', [
            'notes' => $getNoteListAction()
        ]);
    }

    public function create(CreateRequest $request, CreateNoteAction $createNoteAction)
    {
        $createNoteAction($request->validated());

        return redirect()->route('notes');
    }

    public function delete($id, DeleteNoteAction $deleteNoteAction)
    {
        $deleteNoteAction($id);

        return redirect()->route('notes');
    }
}
