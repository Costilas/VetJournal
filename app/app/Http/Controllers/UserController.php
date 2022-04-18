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
use Illuminate\Support\Facades\Log;
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
        $currentUser = Auth::user();

        return view('admin.users.index', compact('users', 'currentUser'));
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(AddRequest $request)
    {
        $request = $request->validated();
        $request['user']['password'] = Hash::make($request['user']['password']);
        $user = User::create($request['user']);

        try {
            Session::flash('success', "Сотрудник $user->last_name $user->name $user->patronymic успешно добавлен/добавлена.");
        } catch (\Exception $e) {
            return redirect()->route('admin.users')
                ->withErrors('error', 'Сотрудник не был добавлен. Проверьте введенные данные.');
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
        try {
            $user = User::query()->findOrFail($id);
            $user->fill($request['user']);
            $user->save()?
                Session::flash('success', "Данные сотрудника успешно изменены."):
                throw new \Exception('Редактирование не удалось. Проверьте введенные данные и попробуйте снова');
        } catch (\Exception $e) {
            Log::debug($e);
            return redirect()->route('admin.user.edit', ['id'=>$user->id])->withErrors($e);
        }

        return redirect()->route('admin.user.edit', ['id'=>$user->id]);
    }

    public function deactivate($id)
    {
        try {
            $user = User::query()->findOrFail($id);
            $user->fill(['is_active'=>0]);
            $user->save()?
                Session::flash('success', "Профиль сотрудника $user->last_name $user->name успешно деактивирован."):
                throw new \Exception('Деактивация не удалась. Перезагрузите страницу и попробуйте снова.');
        } catch (\Exception $e) {
            Log::debug($e);
            return redirect()->route('admin.users')->withErrors($e);
        }

        return redirect()->route('admin.users');
    }

    public function restore($id)
    {
        try {
            $user = User::query()->findOrFail($id);
            $user->fill(['is_active'=>1]);
            $user->save()?
                Session::flash('success', "Профиль сотрудника $user->last_name $user->name успешно активирован."):
                throw new \Exception('Активация не удалась. Перезагрузите страницу и попробуйте снова.');
        } catch (\Exception $e) {
            Log::debug($e);
            return redirect()->route('admin.users')->withErrors($e);
        }

        return redirect()->route('admin.users');
    }

    public function passwordChange(ChangePasswordRequest $request, $id)
    {
        $request = $request->validated();
        try {
            $user = User::query()->findOrFail($id);
            $user->fill(['password'=>Hash::make($request['user']['password'])]);
            $user->save()?
                Session::flash('success', "Пароль сотрудника $user->last_name $user->name успешно изменен."):
                throw new \Exception('Изменение пароля не удалось. Перезагрузите страницу и попробуйте снова.');
        } catch (\Exception $e) {
            Log::debug($e);
            return redirect()->route('admin.user.edit', ['id'=>$id])->withErrors($e);
        }

        return redirect()->route('admin.user.edit', ['id'=>$id]);
    }

    public function loginChange(ChangeLoginRequest $request, $id)
    {
        $request = $request->validated();
        try {
            $user = User::query()->findOrFail($id);
            $user->fill($request['user']);
            $user->save()?
                Session::flash('success', "Логин сотрудника $user->last_name $user->name успешно изменен."):
                throw new \Exception("Логин сотрудника $user->last_name $user->name не был изменен. Перезагрузите страницу и попробуйте снова.");
        } catch (\Exception $e) {
            Log::debug($e);
            return redirect()->route('admin.user.edit', ['id'=>$id])->withErrors($e);
        }

        return redirect()->route('admin.user.edit', ['id'=>$id]);
    }
}
