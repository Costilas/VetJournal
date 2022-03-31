<?php

namespace App\Http\Controllers;

use App\Filters\CardFilter;
use App\Http\Requests\Card\CreateCardRequest;
use App\Http\Requests\Card\SearchCardRequest;
use App\Models\Owner;


class CardController extends Controller
{
    public function index()
    {
        return view('card.index');
    }

    public function search(SearchCardRequest $request)
    {
        $requestData = $request->validated();
        $filter = new CardFilter(Owner::class, $requestData);
        $ownerIds = $filter->runFiltering();

        $owners = Owner::with('pets.kind')
            ->whereKey($ownerIds)
            ->paginate(10)
            ->withQueryString();

        return view('card.index', compact('owners'));
    }


    public function create(CreateCardRequest $request)
    {
        $validatedData = $request->validated();

        $newOwner = Owner::create($validatedData['owner']);
        $newPet= $newOwner->pets()->create($validatedData['pet']);


        if(!$newOwner->id && !$newPet->id)
        {
            return redirect()->back()
                ->withInput()
                ->withErrors('При добавлении что-то пошло не так');
        }

        return redirect()->route('owner.show', ['id' => $newOwner->id])
            ->with('success', 'Пользователь и питомец успешно добавлены');
    }
}
