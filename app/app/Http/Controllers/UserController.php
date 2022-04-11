<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AddRequest;
use App\Http\Requests\User\ChangeLoginRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search'))
        {
            $validated = $request->validate([
                "search" => [
                    'sometimes',
                    'required',
                    'alpha',
                    Rule::in(['all', 'active', 'inactive']),
                ]
            ], [
                'search.required' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
                'search.alpha' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
                'search.in' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
            ]);

            $query = User::filter($validated);
        } else {
            $query = User::filter(['search'=>'all']);
        }
        $users = $query->paginate(5)->withQueryString();
        $currentUserId = Auth::user()->id;

        return view('admin.users.index', compact('users', 'currentUserId'));
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(AddRequest $request)
    {
        $request = $request->validated();
        $saltedHashedPassword = Hash::make(PasswordService::salting($request['user']['password']));
        $user = User::create([
            'email'=>$request['user']['email'],
            'name'=>$request['user']['name'],
            'patronymic'=>$request['user']['patronymic'],
            'last_name'=>$request['user']['last_name'],
            'password'=>$saltedHashedPassword,
        ]);

        if($user->id)
        {
            Session::flash('success', "Сотрудник $user->last_name $user->name $user->patronymic успешно добавлен/добавлена.");
        }

        return redirect()->route('admin.users');
    }

    public function edit($id)
    {
        $user = User::query()->findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $request = $request->validated();

        $user = User::query()->findOrFail($id);
        $user->name = $request['user']['name'];
        $user->patronymic = $request['user']['patronymic'];
        $user->last_name = $request['user']['last_name'];

        $result = $user->save();
        if($result)
        {
            Session::flash('success', "Данные сотрудника успешно изменены.");
        }

        return redirect()->route('admin.user.edit', ['id'=>$user->id]);
    }

    public function deactivate($id)
    {
        $user = User::query()->findOrFail($id);
        $user->is_active = 0;

        $result = $user->save();
        if($result)
        {
            Session::flash('success', "Профиль сотрудника $user->last_name $user->name успешно дективирован.");
        }

        return redirect()->route('admin.users');
    }

    public function restore($id)
    {
        $user = User::query()->findOrFail($id);
        $user->is_active = 1;

        $result = $user->save();
        if($result)
        {
            Session::flash('success', "Профиль сотрудника $user->last_name $user->name успешно активирован.");
        }

        return redirect()->route('admin.users');
    }

    public function passwordChange(ChangePasswordRequest $request, $id)
    {
        $request = $request->validated();
        $user = User::query()->findOrFail($id);
        $user->password = Hash::make(PasswordService::salting($request['user']['password']));

        $result = $user->save();
        if($result)
        {
            Session::flash('success', "Пароль сотрудника $user->last_name $user->name успешно изменен.");
        }
        else {
            Session::flash('error', "Пароль сотрудника $user->last_name $user->name не был изменен.");
        }

        return redirect()->back();
    }

    public function loginChange(ChangeLoginRequest $request, $id)
    {
        $request = $request->validated();
        $user = User::query()->findOrFail($id);
        $user->email = $request['user']['email'];

        $result = $user->save();
        if($result)
        {
            Session::flash('success', "Логин сотрудника $user->last_name $user->name успешно изменен.");
        }
        else {
            Session::flash('error', "Логин сотрудника $user->last_name $user->name не был изменен.");
        }

        return redirect()->back();
    }
}
