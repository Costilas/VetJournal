<?php

namespace App\Actions\Note;

use App\Actions\Action;
use App\Models\Note;
use Illuminate\Support\Facades\Session;

class CreateNoteAction extends Action
{
    public function __construct(private Note $note)
    {
        parent::__construct();
    }

    public function __invoke(array $validatedData)
    {
        return $this->note->create($this->typeChecker->checkArrayDataType($validatedData))
            ?Session::flash('success', "Заметка успешно добавлена!")
            :throw new \Exception();
    }
}
