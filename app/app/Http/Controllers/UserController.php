<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AddRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('all'))
        {
            $users = User::query()->paginate(5);
        } else {
            //$users = User::query()->where('is_active', '=', '1')->paginate(5);
            $users = User::query()->paginate(5);
        }

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(AddRequest $request)
    {
        //метод для засолки пароля
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

    public function update(UpdateRequest $request)
    {
        return view('admin.users.edit');
    }

    public function deactivate($id)
    {
        $user = User::query()->findOrFail($id);
        $user->is_active = 0;
        $user->save();

        if(!$user->is_active)
        {
            Session::flash('success', "Профиль сотрудника $user->last_name $user->name успешно дективирован.");
        }

        return redirect()->route('admin.users');
    }

    public function restore($id)
    {
        $user = User::query()->findOrFail($id);
        $user->is_active = 1;
        $user->save();

        if($user->is_active)
        {
            Session::flash('success', "Профиль сотрудника $user->last_name $user->name успешно активирован.");
        }

        return redirect()->route('admin.users');
    }

    public function passwordChange(ChangePasswordRequest $request, $id)
    {
        $user = User::query()->findOrFail($id);
        $old = $user->password;
        $user->password = Hash::make(PasswordService::salting($request['user']['password']));
        $user->save();

        if($user->password !== $old)
        {
            Session::flash('success', "Пароль сотрудника $user->last_name $user->name успешно изменен.");
        }
        else {
            Session::flash('error', "Пароль сотрудника $user->last_name $user->name не был изменен.");
        }

        return redirect()->back();
    }

    public function auth(LoginRequest $request)
    {
        if(Auth::attempt(
            [
            'email'=>$request['user']['email'],
            'password'=>PasswordService::salting($request['user']['password']),
            'is_active'=>1
            ]))
        {
            Session::flash('success', "Добро пожаловать, ". auth()->user()->name . ". Вход успешно выполнен!");
            return redirect()->route('notes');
        }

        return redirect()->back()->withErrors('Данные неверны или ваш профиль заблокирован');
    }

    public function login()
    {
        return view('login.index');
    }

    public function logout()
    {
        Auth::logout();
        if(!Auth::check()){
            Session::flash('success', "Выход выполнен!");
        }
        return redirect()->route('login');
    }


}
