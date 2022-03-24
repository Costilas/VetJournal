<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function index(Request $request)
    {
        // Сделать валидацию
        // Вынести функционал проверки в отдельную функцию или контроллер

        if ($request->has('search') || $request->has('page')) {
            $query = Owner::with(['pets', 'pets.kind'])->select(['*', 'owners.id as id']);

            if ($request->pet_name) {
                $query->leftJoin('pets', 'owners.id', '=', 'pets.owner_id')
                    ->where('pet_name', 'LIKE', "$request->pet_name%");
            }
            if ($request->name) {
                $query->where('name', 'LIKE', "$request->name%");
            }
            if ($request->patronymic) {
                $query->where('patronymic', 'LIKE', "$request->patronymic%");
            }
            if ($request->last_name) {
                $query->where('last_name', 'LIKE', "$request->last_name%");
            }
            if ($request->phone) {
                $query->where('phone', 'LIKE', "$request->phone%");
            }

            $owners = $query->paginate(10)->withQueryString();

            return view('card.index', compact('owners'));
        }

        return view('card.index');
    }


    public function create(Request $request)
    {
        //Сделать валидацию
        $newOwner = Owner::create([
            'name' => $request->name,
            'patronymic' => $request->patronymic,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        $newPet = Pet::create([
            'pet_name' => $request->pet_name,
            'owner_id' => $newOwner->id,
            'kind_id' => $request->kind,
            'gender_id' => $request->gender,
            'birth' => $request->birth
        ]);

        //Сделать проверку на успешное дополнение

        return redirect(route('owner.show', ['id' => $newOwner->id]));
    }
}
