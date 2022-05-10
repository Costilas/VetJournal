<?php

namespace App\Http\Controllers;

use App\Actions\Note\CreateNoteAction;
use App\Actions\Note\DeleteNoteAction;
use App\Actions\Note\GetNoteListAction;
use App\Http\Requests\Note\CreateRequest;
use Illuminate\Support\Facades\Log;

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
        $validatedData = $request->validated();
        try {
            $createNoteAction($validatedData);
        } catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()->route('notes')
                ->withErrors('Добавление карточки не выполнено. Перезагрузите страницу и попробуйте снова');
        }

        return redirect()->route('notes');
    }

    public function delete($id, DeleteNoteAction $deleteNoteAction)
    {
        try{
            $deleteNoteAction($id);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()->route('notes')
                ->withErrors('Произошла ошибка удаления заметки. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('notes');
    }
}
