<?php

namespace App\Http\Controllers;

use App\Http\Requests\Owner\EditRequest;
use App\Models\Owner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OwnerController extends Controller
{
    public function show(Owner $owner)
    {
        $pets = $owner->pets()->with('kind', 'gender', 'castration')->paginate(5);

        return view('owner.show', compact('owner', 'pets'));
    }

    public function update(EditRequest $request, Owner $owner)
    {
        $validatedRequest = $request->validated();
        try{
            $owner->fill($validatedRequest)?->save()
                ? Session::flash('success', "Профиль владельца успешно отредактирован!")
                : throw new \Exception('Ошибка при редактировании профиля владельца. Перезагрузите страницу и попробуйте снова.');
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('owner.show', ['owner' => $owner])
                ->withErrors($e->getMessage());
        }

        return redirect()->route('owner.show', ['owner' => $owner]);
    }
}
