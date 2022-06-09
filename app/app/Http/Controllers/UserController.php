<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AddRequest;
use App\Http\Requests\User\ChangeLoginRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('search'))
        {
            $validatedRequest = $request->validate([
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

            $query = User::filter($validatedRequest);
        } else {
            $query = User::filter(['search'=>'all']);
        }
        $users = $query->with('roles')->paginate(5)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.add', [
            'currentUser'=> Auth::user()
        ]);
    }

    public function store(AddRequest $request)
    {
        $validatedRequest = $request->validated();
        try {
            $validatedRequest['user']['password'] = Hash::make($validatedRequest['user']['password']);

            $validatedRequest['user']['is_admin'] = $validatedRequest['user']['is_admin']??0;

            $validatedRequest['user']['is_active'] = 1;
            $user = User::create($validatedRequest['user']);

            /*$user->assignRole('doctor');
            if(isset($validatedRequest['user']['is_admin'])) {$user->assignRole('admin');}*/

            Session::flash('success', "Сотрудник $user->last_name $user->name $user->patronymic успешно добавлен/добавлена.");
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.users')
                ->withErrors( 'Сотрудник не был добавлен. Проверьте введенные данные.');
        }

        return redirect()->route('admin.users');
    }

    public function edit($id)
    {
        try{
            $currentUser = Auth::user();
            $user = User::query()->findOrFail($id);
            if($user->is_dev&&!$currentUser->is_dev){throw new \Exception();}
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.users')->withErrors('Ошибочная операция');
        }


        return view('admin.users.edit', compact('user', 'currentUser'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $validatedRequest = $request->validated();
        try {
            $currentUser = Auth::user();
            $user = User::query()->findOrFail($id);
            if($user->is_dev&&!$currentUser->is_dev){throw new \Exception();} //'Ошибочная операция'
            $user->fill($validatedRequest['user']);
            $user->save()?
                Session::flash('success', "Данные сотрудника успешно изменены."):
                throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.user.edit', ['id'=>$user->id])->withErrors('Редактирование не удалось. Проверьте введенные данные и попробуйте снова');
        }

        return redirect()->route('admin.user.edit', ['id'=>$user->id]);
    }

    public function deactivate($id)
    {
        try {
            $currentUser = Auth::user();
            if($currentUser->id==$id){throw new \Exception();} //'Пользователь не может деактивировать сам себя'
            $user = User::query()->findOrFail($id);
            if($user->is_dev&&!$currentUser->is_dev){throw new \Exception();} //'Ошибочная операция'
            $user->fill(['is_active'=>0]);
            $user->save()?
                Session::flash('success', "Профиль сотрудника $user->last_name $user->name успешно деактивирован."):
                throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.users')->withErrors('Деактивация не удалась. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('admin.users');
    }

    public function activate($id)
    {
        try {
            $currentUser = Auth::user();
            if($currentUser->id===$id){throw new \Exception();} //'Пользователь не может активировать сам себя'
            $user = User::query()->findOrFail($id);
            if($user->is_dev&&!$currentUser->is_dev){throw new \Exception();} //'Ошибочная операция'
            $user->fill(['is_active'=>1]);
            $user->save()?
                Session::flash('success', "Профиль сотрудника $user->last_name $user->name успешно активирован."):
                throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.users')->withErrors('Активация не удалась. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('admin.users');
    }

    public function passwordChange(ChangePasswordRequest $request, $id)
    {
        $validatedRequest = $request->validated();
        try {
            $currentUser = Auth::user();
            $user = User::query()->findOrFail($id);
            if($user->is_dev&&!$currentUser->is_dev){throw new \Exception();} //'Ошибочная операция'
            $user->fill(['password'=>Hash::make($validatedRequest['user']['password'])]);
            $user->save()?
                Session::flash('success', "Пароль сотрудника $user->last_name $user->name успешно изменен."):
                throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.user.edit', [
                'id'=>$id
            ])->withErrors('Изменение пароля не удалось. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('admin.user.edit', ['id'=>$id]);
    }

    public function loginChange(ChangeLoginRequest $request, $id)
    {
        $validatedRequest = $request->validated();
        try {
            $currentUser = Auth::user();
            $user = User::query()->findOrFail($id);
            if($user->is_dev&&!$currentUser->is_dev){throw new \Exception('Ошибочная операция');}
            $user->fill($validatedRequest['user']);
            $user->save()?
                Session::flash('success', "Логин сотрудника $user->last_name $user->name успешно изменен."):
                throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.user.edit', [
                'id'=>$id
            ])->withErrors("Логин сотрудника $user->last_name $user->name не был изменен. Перезагрузите страницу и попробуйте снова.");
        }

        return redirect()->route('admin.user.edit', ['id'=>$id]);
    }

    public function promoteAdmin($id)
    {
        try {
            $currentUser = Auth::user();
            if(!$currentUser->is_dev){throw new \Exception();} //'Ошибочная операция(1)'
            if($currentUser->id==$id){throw new \Exception();} //'Ошибочная операция(2)'
            $user = User::query()->findOrFail($id);
            if($user->is_dev&&!$currentUser->is_dev){throw new \Exception();} //'Ошибочная операция(3)'
            $user->fill(['is_admin'=>1]);
            $user->save()?
                Session::flash('success', "Сотруднику $user->last_name $user->name предоставлены администраторские права."):
                throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.users')->withErrors('Деактивация не удалась. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('admin.user.edit', ['id'=>$id]);
    }

    public function demoteAdmin($id)
    {
        try {
            $currentUser = Auth::user();
            if(!$currentUser->is_dev){throw new \Exception();} //'Ошибочная операция(1)'
            if($currentUser->id==$id){throw new \Exception();} //'Ошибочная операция(2)'
            $user = User::query()->findOrFail($id);
            if($user->is_dev&&!$currentUser->is_dev){throw new \Exception();} //'Ошибочная операция(3)'
            $user->fill(['is_admin'=>0]);
            $user->save()?
                Session::flash('success', "С сотрудника $user->last_name $user->name сняты администраторские права."):
                throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.users')->withErrors('Операция изменения прав не удалась. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('admin.user.edit', ['id'=>$id]);
    }
}
