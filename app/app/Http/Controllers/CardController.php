<?php

namespace App\Http\Controllers;

use App\Http\Requests\Card\CreateRequest;
use App\Http\Requests\Card\SearchRequest;
use App\Models\Owner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CardController extends Controller
{
    private const FILTER_INPUT_TRANSLATIONS = [
        'lastName' => 'Фамилия',
        'name' => 'Имя',
        'patronymic'=>'Отчество',
        'phone'=>'Телефон',
        'pets'=>'Кличка питомца'
    ];



    public function index()
    {
        return view('card.index');
    }

    public function search(SearchRequest $request)
    {
        $validatedData = $request->validated();
        $owners = Owner::filter($validatedData)->with('pets.kind')->paginate(10)->withQueryString();

        $filterCondition = [];
        foreach(array_filter($validatedData) as $inputName => $inputCondition){
          if(key_exists($inputName,self::FILTER_INPUT_TRANSLATIONS)) {
              $filterCondition[self::FILTER_INPUT_TRANSLATIONS[$inputName]] = $inputCondition;
          }
        }

        return view('card.index', compact('owners', 'filterCondition'));
    }

    public function store(CreateRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $newOwner = Owner::create($validatedData['owner']);
            $newOwner->pets()->create($validatedData['pet']);
            Session::flash('success', "Новая карточка успешно создана!");
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('cards')->withErrors('При создании карточки что-то пошло не так. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('owner.show', ['id' => $newOwner->id]);
    }
}
