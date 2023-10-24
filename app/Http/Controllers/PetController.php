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

    /**
     * Display the specified pet's information along with its last 5 visits.
     *
     * @param int $id The ID of the pet to display
     * @return \Illuminate\View\View The view displaying the pet's details
     */
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

    /**
     * Search and display the pet's visits based on the provided filters.
     *
     * @param SearchPetVisitsRequest $request The request containing search filters for the pet's visits
     * @param DescribeFilterAction $filterDescriber The action used to describe filter conditions
     * @param int $id The ID of the pet to display
     * @return \Illuminate\View\View The view displaying the pet's details along with filtered visits
     */
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

    /**
     * Display the form for editing the specified pet.
     *
     * @param int $id The ID of the pet to edit
     * @return \Illuminate\View\View The view containing the edit form for the pet
     */
    public function edit(int $id)
    {
        $pet = $this->petService->getPet($id, ['kind', 'gender', 'owner']);

        return view('pet.edit', [
            'pet' => $pet
        ]);
    }

    /**
     * Update the specified pet in the database.
     *
     * @param EditExistingPetRequest $request The validated request containing updated pet data
     * @param int $id The ID of the pet to update
     * @return \Illuminate\Http\RedirectResponse Redirects to the edit page with success or error message
     */
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
