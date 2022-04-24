<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\AddRequest;
use App\Models\Note;
use App\Models\Status;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('status')->orderBy('created_at', 'DESC')->paginate(10);
        $statuses = Status::all();

        return view('notes.index', compact('notes', 'statuses'));
    }

    public function create(AddRequest $request)
    {
        $validatedRequestData = $request->validated();
        try {
            Note::create($validatedRequestData)
                ?Session::flash('success', "Заметка успешно добавлена!")
                :throw new \Exception();
        } catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()->route('notes')->withErrors('Добавление карточки не выполнено. Перезагрузите страницу и попробуйте снова');
        }

        return redirect(route('notes'));
    }

    public function delete($id)
    {
        try{
            $note = Note::find($id);
            $note?->delete()
                ? Session::flash('success', "Заметка удалена!")
                : throw new \Exception('При удалении заметки произошла ошибка. Попробуйте перезагрузить страницу и выполнить действие снова.');
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()->route('notes')->withErrors($e->getMessage());
        }

        return redirect()->route('notes');
    }
}
