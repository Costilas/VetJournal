<?php

namespace App\Http\Controllers;

use App\Actions\User\Activation\ActivateUserAction;
use App\Actions\User\Edition\ChangeUserLoginAction;
use App\Actions\User\Edition\ChangeUserPasswordAction;
use App\Actions\User\Creation\CreateUserAction;
use App\Actions\User\Activation\DeactivateUserAction;
use App\Actions\User\Edition\GetEditableUserAction;
use App\Actions\User\Filtering\GetFilteredUserListAction;
use App\Actions\User\Filtering\GetUnfilteredUserListAction;
use App\Actions\User\Edition\UpdateUserAction;
use App\Actions\User\Promotion\DemoteUserAction;
use App\Actions\User\Promotion\PromoteUserAction;
use App\Http\Requests\User\AddRequest;
use App\Http\Requests\User\ChangeLoginRequest;
use App\Http\Requests\User\SearchRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;

class UserController extends Controller
{

    public function index(GetUnfilteredUserListAction $getUnfilteredUserListAction)
    {
        return view('admin.users.index', [
            'users'=> $getUnfilteredUserListAction(),
        ]);
    }

    public function search(
        SearchRequest $request,
        GetFilteredUserListAction $getFilteredUserListAction
    )
    {
        return view('admin.users.index', [
            'users' => $getFilteredUserListAction($request->validated()),
        ]);
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(
        AddRequest $request,
        CreateUserAction $createUserAction
    )
    {
        $createUserAction($request->validated());

        return redirect()->route('admin.users');
    }

    public function edit(
        User $targetUser,
        GetEditableUserAction $getEditableUserAction
    )
    {
        return view('admin.users.edit', [
            'targetUser' => $getEditableUserAction($targetUser)
        ]);
    }

    public function update(
        UpdateRequest $request,
        User $targetUser,
        UpdateUserAction $updateUserAction,
        GetEditableUserAction $getEditableUserAction
    )
    {
        return redirect()->route('admin.user.edit', [
            'targetUser'=>$updateUserAction($getEditableUserAction($targetUser), $request->validated())
        ]);
    }

    public function deactivate(
        User $targetUser,
        DeactivateUserAction $deactivateUserAction,
        GetEditableUserAction $getEditableUserAction
    )
    {
        $deactivateUserAction($getEditableUserAction($targetUser));

        return redirect()->route('admin.users');
    }

    public function activate(
        User $targetUser,
        ActivateUserAction $activateUserAction,
        GetEditableUserAction $getEditableUserAction
    )
    {
        $activateUserAction($getEditableUserAction($targetUser));

        return redirect()->route('admin.users');
    }

    public function passwordChange(
        ChangePasswordRequest $request,
        User $targetUser,
        ChangeUserPasswordAction $changeUserPasswordAction,
        GetEditableUserAction $getEditableUserAction
    )
    {
        return redirect()->route('admin.user.edit', [
            'targetUser'=>$changeUserPasswordAction($getEditableUserAction($targetUser), $request->validated())
        ]);
    }

    public function loginChange(
        ChangeLoginRequest $request,
        User $targetUser,
        ChangeUserLoginAction $changeUserLoginAction,
        GetEditableUserAction $getEditableUserAction
    )
    {
        return redirect()->route('admin.user.edit', [
            'targetUser'=>$changeUserLoginAction($getEditableUserAction($targetUser), $request->validated())
        ]);
    }

    public function promote(
        User $targetUser,
        PromoteUserAction $promoteUserAction,
        GetEditableUserAction $getEditableUserAction
    )
    {
        return redirect()->route('admin.user.edit', [
            'targetUser'=>$promoteUserAction($getEditableUserAction($targetUser))
        ]);
    }

    public function demote(
        User $targetUser,
        DemoteUserAction $demoteUserAction,
        GetEditableUserAction $getEditableUserAction
    )
    {
        return redirect()->route('admin.user.edit', [
            'targetUser'=>$demoteUserAction($getEditableUserAction($targetUser))
        ]);
    }
}
