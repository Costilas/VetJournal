<?php

namespace App\Actions\Note;

use App\Models\Note;
use Illuminate\Support\Facades\Session;

class DeleteNoteAction
{
    public function __construct(private Note $note)
    {}

    public function __invoke(int $id)
    {
        $note = $this->note->find($id);
        $note?->delete()
            ? Session::flash('success', "Заметка удалена!")
            : throw new \Exception('При удалении заметки произошла ошибка. Попробуйте перезагрузить страницу и выполнить действие снова.');
    }
}
