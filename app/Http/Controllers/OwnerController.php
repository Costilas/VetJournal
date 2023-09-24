<?php

namespace App\Http\Controllers;

use App\Actions\Common\DescribeFilterAction;
use App\Http\Requests\Owner\CreateNewOwnerRequest;
use App\Http\Requests\Owner\EditExistingOwnerRequest;
use App\Http\Requests\Owner\SearchExistingOwnerRequest;
use App\Models\Owner;
use App\Services\Owner\OwnerService;

class OwnerController extends Controller
{

    public function __construct(
        protected OwnerService $ownerService
    ){}

    public function index()
    {
        return view('owner.index');
    }

    public function show(Owner $owner)
    {
        return view('owner.show', [
            'owner' => $owner,
            'pets' => $owner->pets()->with('kind', 'gender', 'castration')->paginate(5)
        ]);
    }

    public function search(SearchExistingOwnerRequest $request, DescribeFilterAction $describeFilterAction)
    {
        $validatedData = $request->validated();
        $owners = $this->ownerService->searchExistingOwnerWithPets($request);
        $filterCondition = $describeFilterAction($validatedData);

        return view('owner.index', [
            'owners' => $owners,
            'filterCondition' => $filterCondition
        ]);
    }

    public function update(EditExistingOwnerRequest $request, Owner $owner)
    {
        $redirect = redirect()->route('owner.show', ['owner'=> $owner]);
        $successMessage = 'Профиль владельца успешно отредактирован!';
        $errorMessage = 'Ошибка при редактировании профиля владельца. Перезагрузите страницу и попробуйте снова.';

        if($this->ownerService->editExistingOwner($owner, $request)) {
            $redirect->with('success', $successMessage);
        } else {
            $redirect->withErrors($errorMessage);
        }

        return $redirect;
    }

    public function store(CreateNewOwnerRequest $request, )
    {
        $redirect = redirect();
            $redirectRouteError = 'owners';
        $redirectRouteSuccess = 'owner.show';
        $newOwnerWithPets = $this->ownerService->createNewOwnerWithPets($request);
        $newOwnerWithPets
            ? $redirect->route($redirectRouteSuccess, ['owner' => $newOwnerWithPets])
            : $redirect->route($redirectRouteError)->withErrors('Создание новой карточки не удалось.');

        return $redirect;
    }
}
