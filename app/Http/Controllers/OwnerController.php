<?php

namespace App\Http\Controllers;

use App\Actions\Common\DescribeFilterAction;
use App\Http\Requests\Owner\CreateNewOwnerRequest;
use App\Http\Requests\Owner\EditExistingOwnerRequest;
use App\Http\Requests\Owner\SearchExistingOwnerRequest;
use App\Http\Requests\Owner\AttachNewPetsToOwnerRequest;
use App\Services\Owner\OwnerService;
use Illuminate\Http\RedirectResponse;

class OwnerController extends Controller
{

    public function __construct(
        protected OwnerService $ownerService,
    ){}

    public function index()
    {
        return view('owner.index');
    }

    public function show(int $id)
    {
        $owner = $this->ownerService->getOwner($id);
        $ownerPets = $this->ownerService->getOwnerPets($owner, 5);

        return view('owner.show', [
            'owner' => $owner,
            'pets' => $ownerPets
        ]);
    }

    public function search(SearchExistingOwnerRequest $request, DescribeFilterAction $describeFilterAction)
    {
        $validatedData = $request->validated();
        $owners = $this->ownerService->searchExistingOwnerWithPets($request, 5);
        $filterCondition = $describeFilterAction($validatedData);

        return view('owner.index', [
            'owners' => $owners,
            'filterCondition' => $filterCondition
        ]);
    }

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

    public function store(CreateNewOwnerRequest $request): RedirectResponse
    {
        $redirectErrorRoute = 'owners';
        $redirectSuccessRoute = 'owners.show';

        $successMessage = 'Новая карточка успешно создана.';
        $errorMessage = 'Создание новой карточки не удалось.';

        $newOwnerWithPets = $this->ownerService->createNewOwnerWithPets($request);

        if (!empty($newOwnerWithPets)) {
            return redirect()->route($redirectSuccessRoute, ['id' => $newOwnerWithPets->id])->with('success', $successMessage);
        } else {
            return redirect()->route($redirectErrorRoute)->withErrors($errorMessage);
        }
    }

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
