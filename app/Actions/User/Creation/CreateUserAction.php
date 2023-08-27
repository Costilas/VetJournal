<?php

namespace App\Actions\User\Creation;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CreateUserAction
{
    public function __invoke(array $validatedData):User|RedirectResponse
    {
        try {

            $validatedData['user']['password'] = Hash::make($validatedData['user']['password']);
            $validatedData['user']['is_active'] = 1;
            $newUser = User::create($validatedData['user']);
            $newUser->assignRole('doctor');
            if(isset($validatedData['user']['is_admin'])){
                $newUser->assignRole('admin');
            }
            Session::flash('success', "Сотрудник $newUser->last_name $newUser->name $newUser->patronymic успешно добавлен/добавлена.");
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('admin.users')
                ->withErrors( 'Сотрудник не был добавлен. Проверьте введенные данные.');
        }

        return $newUser;
    }
}
