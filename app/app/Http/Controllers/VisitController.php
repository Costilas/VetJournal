<?php

namespace App\Http\Controllers;

use App\Actions\Common\DescribeFilterAction;
use App\Actions\Visit\CreateVisitAction;
use App\Actions\Visit\SearchVisitsAction;
use App\Actions\Visit\UpdateVisitAction;
use App\Http\Requests\Visit\CreateRequest;
use App\Http\Requests\Visit\EditRequest;
use App\Http\Requests\Visit\SearchRequest;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class VisitController extends Controller
{
    public function index(DescribeFilterAction $describeFilterAction, SearchVisitsAction $searchVisitsAction)
    {
        $todayDateString = Carbon::create('today')->toDateString();
        $searchDateRange = ['search'=> [
                'from'=>$todayDateString,
                'to'=>$todayDateString
            ]
        ];

        return view('visit.index', [
            'visits' => $searchVisitsAction($searchDateRange),
            'filterCondition' => $describeFilterAction($searchDateRange),
            'searchDateRange' => $searchDateRange
        ]);
    }

    public function search(SearchRequest $request, DescribeFilterAction $describeFilterAction, SearchVisitsAction $searchVisitsAction)
    {
        $searchDateRange = $request->validated();

        return view('visit.index', [
            'visits' => $searchVisitsAction($searchDateRange),
            'filterCondition' => $describeFilterAction($searchDateRange),
            'searchDateRange' => $searchDateRange
        ]);
    }

    public function create(CreateRequest $request, CreateVisitAction $createVisitAction)
    {
        $validatedRequest = $request->validated();
        $visit = $createVisitAction($validatedRequest);
        return redirect()->route('pet.show', [
            'pet' => $visit->pet_id
        ]);
    }

    public function edit($id)
    {
        return view('visit.edit', [
            'visit' => Visit::with('pet')->find($id)
        ]);
    }

    public function update(EditRequest $request, $id, UpdateVisitAction $updateVisitAction)
    {
        $updatedVisit = $updateVisitAction($request->validated(), $id);

        return redirect()->route('visit.edit', [
            'id'=>$updatedVisit->id
        ]);
    }
}
