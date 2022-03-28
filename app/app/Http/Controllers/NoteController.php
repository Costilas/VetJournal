<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Status;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('status')->orderBy('created_at', 'DESC')->paginate(10);
        $statuses = Status::all();

        return view('notes.index', compact('notes', 'statuses'));
    }

    public function create(Request $request)
    {
        $newNote = Note::create([
            'theme' => $request->theme,
            'body' => $request->body,
            'status_id' => $request->status_id,
        ]);

        return redirect(route('notes'));
    }


    public function delete($id)
    {
        Note::query()->find($id)->delete();

        return redirect(route('notes'));
    }
}
