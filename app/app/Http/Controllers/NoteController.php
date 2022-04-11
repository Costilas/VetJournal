<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\AddRequest;
use App\Models\Note;
use App\Models\Status;
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
        $validatedRequest = $request->validated();
        $newNote = Note::create($validatedRequest);

        if ($newNote->id) {
            Session::flash('success', "Заметка успешно добавлена!");
        }

        return redirect(route('notes'));
    }

    public function delete($id)
    {
        $deleting = Note::query()->find($id)->delete();
        if ($deleting) {
            Session::flash('success', "Заметка удалена!");
        }

        return redirect(route('notes'));
    }
}
