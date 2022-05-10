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
        return $getNoteListAction();
    }

    public function create(CreateRequest $request, CreateNoteAction $createNoteAction)
    {
        $validatedData = $request->validated();

        return $createNoteAction($validatedData);
    }

    public function delete($id, DeleteNoteAction $deleteNoteAction)
    {
        return $deleteNoteAction($id);
    }
}
