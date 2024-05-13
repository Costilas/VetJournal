<?php

namespace App\Http\Controllers;

use App\Actions\Common\DescribeFilterAction;
use App\Http\Requests\Owner\CreateNewOwnerRequest;
use App\Http\Requests\Owner\EditExistingOwnerRequest;
use App\Http\Requests\Owner\SearchExistingOwnerRequest;
use App\Http\Requests\Owner\AttachNewPetsToOwnerRequest;
use App\Services\Owner\OwnerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OwnerController extends Controller
{

    public function __construct(
        protected OwnerService $ownerService,
    ){}

    /**
     * Display the owners' index page.
     *
     * @return View The view for owners index
     */
    public function index()
    {
        return view('owner.index');
    }

    /**
     * Display the specified owner's information along with their last 5 pets.
     *
     * @param int $id The ID of the owner to display
     * @return View The view displaying the owner's details
     */
    public function show(int $id)
    {
        $owner = $this->ownerService->getOwner($id);
        $ownerPets = $this->ownerService->getOwnerPets($owner, 5);

        return view('owner.show', [
            'owner' => $owner,
            'pets' => $ownerPets
        ]);
    }

    /**
     * Search and display owners based on provided search criteria.
     *
     * @param SearchExistingOwnerRequest $request The request containing search filters for the owners
     * @param DescribeFilterAction $describeFilterAction The action to describe the filter conditions
     * @return View The view displaying the filtered list of owners
     */
    public function search(SearchExistingOwnerRequest $request, DescribeFilterAction $describeFilterAction)
    {
        return view('owner.index', [
            'owners' => $this->ownerService->searchExistingOwnerWithPets($request, 5),
            'filterCondition' => $describeFilterAction($request->validated())
        ]);
    }

    /**
     * Update the specified owner in the database.
     *
     * @param EditExistingOwnerRequest $request The validated request containing the owner's updated data
     * @param int $id The ID of the owner to update
     * @return RedirectResponse Redirect to the owner's show page with a success or error message
     */
    public function update(EditExistingOwnerRequest $request, int $id): RedirectResponse
    {
        $successMessage = 'Профиль владельца успешно отредактирован!';
        $errorMessage = 'Ошибка при редактировании профиля владельца. Перезагрузите страницу и попробуйте снова.';

        $redirect = redirect()->route('owners.show', ['id' => $id]);

        if ($this->ownerService->updateExistingOwner($request, $id)) {
            $redirect->with('success', $successMessage);
        } else {
            $redirect->withErrors($errorMessage);
        }

        return $redirect;
    }

    /**
     * Store a newly created owner in the database.
     *
     * @param CreateNewOwnerRequest $request The validated request containing the new owner's data
     * @return RedirectResponse Redirect to the newly created owner's show page with a success or error message
     */
    public function store(CreateNewOwnerRequest $request): RedirectResponse
    {
        $redirectErrorRoute = 'owners';
        $redirectSuccessRoute = 'owners.show';

        $successMessage = __('cards.notifications.create.success');
        $errorMessage = __('cards.notifications.create.fail');

        $newOwnerWithPets = $this->ownerService->createNewOwnerWithPets($request);

        if (!empty($newOwnerWithPets)) {
            return redirect()->route($redirectSuccessRoute, ['id' => $newOwnerWithPets->id])->with('success', $successMessage);
        } else {
            return redirect()->route($redirectErrorRoute)->withErrors($errorMessage);
        }
    }

    /**
     * Attach new pets to the existing owner.
     *
     * @param AttachNewPetsToOwnerRequest $attachNewPetsToOwnerRequest The validated request containing the new pets' data
     * @param int $id The ID of the owner to which new pets will be attached
     * @return RedirectResponse Redirect to the owner's show page with a success or error message
     */
    public function attach(AttachNewPetsToOwnerRequest $attachNewPetsToOwnerRequest, int $id): RedirectResponse
    {
        $successMessage = 'Новый питомец успешно добавлен.';
        $errorMessage = 'При добавлении нового питомца произошла ошибка.';

        $attachmentResult = $this->ownerService->attachNewPetsToOwner($attachNewPetsToOwnerRequest, $id);
        $redirect = redirect()->route('owners.show', ['id' => $id]);

        if (!empty($attachmentResult)) {
            $redirect->with('success', $successMessage);
        } else {
            $redirect->withErrors($errorMessage);
        }

        return $redirect;
    }
}
