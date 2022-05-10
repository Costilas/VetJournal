<?php

namespace App\Actions\Note;

use App\Actions\Action;
use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CreateNoteAction extends Action
{
    public function __construct(private Note $note)
    {
        parent::__construct();
    }

    public function __invoke(array $validatedData)
    {
        try {
            $validatedData = $this->typeChecker->checkArrayDataType($validatedData);
            $this->note->create($this->typeChecker->checkArrayDataType($validatedData))
                ?Session::flash('success', "Заметка успешно добавлена!")
                :throw new \Exception();
        } catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()->route('notes')
                ->withErrors('Добавление заметки не выполнено. Перезагрузите страницу и попробуйте снова');
        }

        return redirect()->route('notes');
    }
}
