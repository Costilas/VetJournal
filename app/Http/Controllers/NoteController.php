<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\CreateNoteRequest;
use App\Services\Note\NoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function __construct(
        private NoteService $noteService
    ){}

    /**
     * Display the index page for notes.
     *
     * @return View The view for the notes index page with paginated notes
     */
    public function index()
    {
        return view('notes.index', [
            'notes' => $this->noteService->getPaginatedNotes(10)
        ]);
    }

    /**
     * Create a new note based on the request data.
     *
     * @param CreateNoteRequest $request The validated request containing the new note's data
     * @return RedirectResponse Redirect to the notes index page with a success or error message
     */
    public function create(CreateNoteRequest $request)
    {
        $route = redirect()->route('notes');

        if($this->noteService->createNewNote($request)) {
            $redirect = $route->with('success', __('notes.notifications.create.success'));
        }else {
            $redirect = $route->withErrors(__('notes.notifications.create.fail'));
        }

        return $redirect;
    }

    /**
     * Delete the specified note.
     *
     * @param int $id The ID of the note to delete
     * @return RedirectResponse Redirect to the notes index page with a success or error message
     */
    public function delete(int $id)
    {
        $route = redirect()->route('notes');

        if($this->noteService->deleteExistingNote($id)) {
            $redirect = $route->with('success', __('notes.notifications.delete.success'));
        }else {
            $redirect = $route->withErrors(__('notes.notifications.delete.fail'));
        }

        return $redirect;
    }
}
