<?php

namespace App\Actions\Pet;

use App\Actions\Common\DescribeFilterAction;
use App\Models\Pet;

class SearchPetVisitsAction
{
    public function __construct(private DescribeFilterAction $filterDescriber)
    {}

    public function __invoke(Pet $pet, array $validatedData)
    {
        $pet->load('gender', 'kind', 'owner');
        $describerInvoke = $this->filterDescriber;

        return view('pet.show', [
            'pet' => $pet,
            'owner' => $pet->owner,
            'visits' => $pet->visits()
                ->filter($validatedData)
                ->with('user')
                ->latest('visit_date')
                ->paginate(5)
                ->withQueryString(),
            'filterCondition'=> $describerInvoke($validatedData),
        ]);
    }
}
