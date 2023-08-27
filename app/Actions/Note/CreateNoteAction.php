<?php

namespace App\Actions\Note;

use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CreateNoteAction
{
    public function __invoke(array $validatedData)
    {
        try {
            Note::create($validatedData)
                ?Session::flash('success', "Заметка успешно добавлена!")
                :throw new \Exception();
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()->route('notes')
                ->withErrors('Добавление заметки не выполнено. Перезагрузите страницу и попробуйте снова');
        }

        return true;
    }
}
