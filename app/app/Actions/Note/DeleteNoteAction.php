<?php

namespace App\Actions\Note;

use App\Actions\Action;
use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DeleteNoteAction extends Action
{
    public function __construct(private Note $note)
    {
        parent::__construct();
    }

    public function __invoke(int $id)
    {
        try{
            $note = $this->note->find($id);
            $note?->delete()
                ? Session::flash('success', "Заметка удалена!")
                : throw new \Exception();
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()->route('notes')
                ->withErrors('Произошла ошибка удаления заметки. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('notes');

    }
}
