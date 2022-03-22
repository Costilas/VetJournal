<?php

namespace App\Http\Controllers;


use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    public function index() {

        return view('search.index');
    }

    public function searchPatient(Request $request)
    {
        $query = Owner::query();
        if ($request->pet_name) {
            $query = Owner::query()->select(['*', 'owners.id as id']);
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

        $owners = $query->paginate(10);

        return view('search.index', compact('owners'));
    }
}
