<?php

namespace App\Http\Controllers;

use App\Actions\Common\DescribeFilterAction;
use App\Http\Requests\Pet\EditExistingPetRequest;
use App\Http\Requests\Pet\SearchPetVisitsRequest;
use App\Services\Pet\PetService;
use Illuminate\Http\RedirectResponse;

class PetController extends Controller
{
    public function __construct(
        protected PetService $petService
    ){}

    public function show(int $id)
    {
        $pet = $this->petService->getPet($id, ['gender', 'kind', 'owner', 'castration']);
        $petVisits = $this->petService->getPetVisits($pet, 5);

        return view('pet.show', [
            'pet' => $pet,
            'owner' => $pet->owner,
            'visits' => $petVisits
        ]);
    }

    public function searchVisits(SearchPetVisitsRequest $request, DescribeFilterAction $filterDescriber, int $id)
    {
        $pet = $this->petService->getPet($id, ['gender', 'kind', 'owner', 'castration']);
        $petVisits = $this->petService->getPetVisits($pet, 5, $request);

        return view('pet.show', [
            'pet' => $pet,
            'owner' => $pet->owner,
            'visits' => $petVisits,
            'filterCondition'=> $filterDescriber($request->validated()),
        ]);
    }

    public function edit(int $id)
    {
        $pet = $this->petService->getPet($id, ['kind', 'gender', 'owner']);

        return view('pet.edit', [
            'pet' => $pet
        ]);
    }

    public function update(EditExistingPetRequest $request, int $id): RedirectResponse
    {
        $successMessage = 'Данные питомца успешно отредактированы!';
        $errorMessage = 'Ошибка при редактировании данных питомца. Перезагрузите страницу и попробуйте снова.';

        $redirect = redirect()->route('pets.edit', ['id' => $id]);

        if ($this->petService->updateExistingPet($request, $id)) {
            $redirect->with('success', $successMessage);
        } else {
            $redirect->withErrors($errorMessage);
        }

        return $redirect;
    }
}
