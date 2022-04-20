<?php

namespace App\Http\Controllers;

use App\Http\Requests\Owner\EditRequest;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OwnerController extends Controller
{
    public function show($id)
    {
        $owner = Owner::findOrFail($id);
        $pets = Pet::where('owner_id', $id)->with('kind', 'gender')->paginate(5);

        return view('owner.show', compact('owner', 'pets'));
    }

    public function update(EditRequest $request, $id)
    {
        $validatedRequest = $request->validated();
        try{
            $owner = Owner::findOrFail($id);
            $owner->fill($validatedRequest['owner']);
            $owner->save()?
                Session::flash('success', "Профиль владельца успешно отредактирован!"):
                throw new \Exception('Ошибка при редактировании профиля владельца. Перезагрузите страницу и попробуйте снова.');
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('owner.show', ['id' => $id])
                ->withErrors($e->getMessage());
        }

        return redirect()->route('owner.show', ['id' => $id]);
    }
}
