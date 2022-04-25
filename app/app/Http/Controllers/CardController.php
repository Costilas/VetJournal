<?php

namespace App\Http\Controllers;

use App\Helpers\FilterConditionDescriber;
use App\Http\Requests\Card\CreateRequest;
use App\Http\Requests\Card\SearchRequest;
use App\Models\Owner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CardController extends Controller
{

    public function index()
    {
        return view('card.index');
    }

    public function search(SearchRequest $request, FilterConditionDescriber $filterDescriber)
    {
        $validatedData = $request->validated();
        $owners = Owner::filter($validatedData)->with('pets.kind')->paginate(10)->withQueryString();
        $filterCondition = $filterDescriber->describeFilterCondition($validatedData);

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
