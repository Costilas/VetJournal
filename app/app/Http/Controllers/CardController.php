<?php

namespace App\Http\Controllers;

use App\Actions\Card\CreateCardAction;
use App\Actions\Card\SearchCardAction;
use App\Actions\Common\DescribeFilterAction;
use App\Http\Requests\Card\CreateRequest;
use App\Http\Requests\Card\SearchRequest;

class CardController extends Controller
{
    public function index()
    {
        return view('card.index');
    }

    public function search(SearchRequest $request, SearchCardAction $searchCardAction, DescribeFilterAction $describeFilterAction)
    {
        $validatedData = $request->validated();

        return view('card.index', [
            'owners' => $searchCardAction($validatedData),
            'filterCondition' => $describeFilterAction($validatedData)
        ]);
    }

    public function store(CreateRequest $request, CreateCardAction $createCardAction)
    {
        $validatedData = $request->validated();

        return $createCardAction($validatedData);
    }
}
