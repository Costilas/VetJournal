<?php

namespace App\Actions\Note;

use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DeleteNoteAction
{
    public function __invoke(int $id)
    {
        try{
            $note = Note::find($id);
            $note?->delete()
                ?Session::flash('success', "Заметка удалена!")
                :throw new \Exception();
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()->route('notes')
                ->withErrors('Произошла ошибка удаления заметки. Перезагрузите страницу и попробуйте снова.');
        }

        return true;
    }
}
