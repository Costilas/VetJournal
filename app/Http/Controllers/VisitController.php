<?php

namespace App\Http\Controllers;

use App\Actions\Common\DescribeFilterAction;
use App\DTOs\Visit\SearchVisitsDTO;
use App\Http\Requests\Visit\CreateNewVisitRequest;
use App\Http\Requests\Visit\EditExistingVisitRequest;
use App\Http\Requests\Visit\SearchVisitsRequest;
use App\Models\Visit;
use App\Services\Visit\VisitService;
use Carbon\Carbon;

class VisitController extends Controller
{

    public function __construct(
        private VisitService $visitService
    ){}

    /**
     * Display the index view with the list of visits for today.
     *
     * @param DescribeFilterAction $describeFilterAction The action to describe the filter conditions
     * @return \Illuminate\View\View The index view populated with the list of visits and filter conditions
     */
    public function index(DescribeFilterAction $describeFilterAction)
    {
        $todayDateString = Carbon::create('today')->toDateString();
        $searchDateRange = [
            'search'=> [
                'from'=>$todayDateString,
                'to'=>$todayDateString
            ]
        ];

        return view('visit.index', [
            'visits' => $this->visitService->searchExistingVisits(new SearchVisitsDTO($searchDateRange), 10),
            'filterCondition' => $describeFilterAction($searchDateRange),
            'searchDateRange' => $searchDateRange
        ]);
    }

    /**
     * Perform a search based on user input and display the list of visits.
     *
     * @param SearchVisitsRequest $request The validated request containing the search parameters
     * @param DescribeFilterAction $describeFilterAction The action to describe the filter conditions
     * @return \Illuminate\View\View The index view populated with the list of visits and filter conditions
     */
    public function search(SearchVisitsRequest $request, DescribeFilterAction $describeFilterAction)
    {
        $searchDateRange = $request->validated();

        return view('visit.index', [
            'visits' => $this->visitService->searchExistingVisits(new SearchVisitsDTO($searchDateRange), 10),
            'filterCondition' => $describeFilterAction($searchDateRange),
            'searchDateRange' => $searchDateRange
        ]);
    }

    /**
     * Create a new visit and redirect to the appropriate route.
     *
     * @param CreateNewVisitRequest $request The validated request containing the new visit data
     * @return \Illuminate\Http\RedirectResponse A redirect to the show page of the pet related to the visit
     */
    public function create(CreateNewVisitRequest $request)
    {
        $validatedRequest = $request->validated();
        $redirectErrorRoute = 'pets.show';
        $redirectSuccessRoute = 'pets.show';

        $successMessage = 'Новый прием успешно создан.';
        $errorMessage = 'Ошибка при создании приема. Перезагрузите страницу и попробуйте снова.';

        $newVisit = $this->visitService->createNewVisit($request);

        if (!empty($newVisit)) {
            return redirect()->route($redirectSuccessRoute, ['id' => $newVisit->pet_id])->with('success', $successMessage);
        } else {
            return redirect()->route($redirectErrorRoute, ['id' => $validatedRequest['visit']['pet_id']])->withErrors($errorMessage);
        }
    }

    /**
     * Display the edit view for a specific visit.
     *
     * @param int $id The ID of the visit to be edited
     * @return \Illuminate\View\View The edit view populated with the visit data
     */
    public function edit($id)
    {
        return view('visit.edit', [
            'visit' => $this->visitService->getVisit($id)
        ]);
    }

    /**
     * Update an existing visit and redirect to the edit view.
     *
     * @param EditExistingVisitRequest $request The validated request containing the updated visit data
     * @param int $id The ID of the visit to be updated
     * @return \Illuminate\Http\RedirectResponse A redirect to the edit page of the updated visit
     */
    public function update(EditExistingVisitRequest $request, int $id)
    {
        $successMessage = 'Прием успешно изменен!';
        $errorMessage = 'Произошла ошибка обновления приема, обновите страницу и попробуйте снова.';

        $redirect = redirect()->route('visits.edit', ['id' => $id]);

        if ($this->visitService->updateExistingVisit($request, $id)) {
            $redirect->with('success', $successMessage);
        } else {
            $redirect->withErrors($errorMessage);
        }

        return $redirect;
    }
}
