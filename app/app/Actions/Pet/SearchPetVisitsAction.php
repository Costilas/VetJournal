<?php

namespace App\Actions\Pet;

use App\Actions\Action;
use App\Actions\Common\DescribeFilterAction;
use App\Models\Pet;

class SearchPetVisitsAction extends Action
{
    public function __invoke(Pet $pet, DescribeFilterAction $filterAction, array $validatedData)
    {
        $pet->load('gender', 'kind', 'owner');

        return view('pet.show', [
            'pet' => $pet,
            'owner' => $pet->owner,
            'visits' => $pet->visits()
                ->filter($validatedData)
                ->with('user')
                ->latest()
                ->paginate(5)
                ->withQueryString(),
            'filterCondition' => $filterAction($validatedData)
        ]);
    }
}
