<?php

namespace App\Actions\Card;

use App\Actions\Action;
use App\Models\Owner;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CreateCardAction extends Action
{
    public function __construct(private Owner $owner, private DatabaseManager $databaseManager)
    {
        parent::__construct();
    }

    public function __invoke(array $validatedData)
    {
        try {
            $validatedData = $this->typeChecker->checkArrayDataType($validatedData);

            $newOwner = $this->databaseManager->transaction(function () use($validatedData) {
                $newOwner = $this->owner->create(
                    $this->typeChecker->checkArrayDataType($validatedData['owner'])
                );
                $newOwner->pets()->create(
                    $this->typeChecker->checkArrayDataType($validatedData['pet'])
                );
                Session::flash('success', "Новая карточка успешно создана!");
                return $newOwner;
            });;
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('cards')
                ->withErrors('При создании карточки что-то пошло не так. Перезагрузите страницу и попробуйте снова.');
        }


        return redirect()->route('owner.show', ['owner' => $newOwner]);
    }

}
