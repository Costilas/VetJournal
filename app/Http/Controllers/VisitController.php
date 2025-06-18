<?php

namespace App\Http\Controllers;

use App\Actions\Common\DescribeFilterAction;
use App\DTOs\Visit\GetVisitsByDateDTO;
use App\Http\Requests\Visit\CreateNewVisitRequest;
use App\Http\Requests\Visit\EditExistingVisitRequest;
use App\Http\Requests\Visit\SearchVisitsRequest;
use App\Services\Visit\VisitService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class VisitController extends Controller
{
    public function __construct(
        private readonly VisitService $visitService
    )
    {
    }

    /**
     * Display the index view with the list of visits for today.
     *
     * @param DescribeFilterAction $describeFilterAction The action to describe the filter conditions
     */
    public function index(
        DescribeFilterAction $describeFilterAction
    ): Factory|\Illuminate\Contracts\View\View|RedirectResponse|Application
    {
        try {
            $from = new Carbon('today', config('CLINIC_TIMEZONE'));
            $to = new Carbon('today', config('CLINIC_TIMEZONE'));

            $searchVisitDTO = new GetVisitsByDateDTO($from, $to, 10);

            $searchDateRange = [
                'search' => [
                    'from' => $searchVisitDTO->from(),
                    'to' => $searchVisitDTO->to(),
                ]
            ];

            $return = view('visit.index', [
                'visits' => $this->visitService->getVisitsByDate($searchVisitDTO),
                'filterCondition' => $describeFilterAction($searchDateRange),
                'searchDateRange' => $searchDateRange
            ]);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            $return = redirect()->route('visits.index')->withErrors('Ошибка валидации. Даты имеют неверный формат');
        }

        return $return;
    }

    /**
     * Perform a search based on user input and display the list of visits.
     *
     * @param SearchVisitsRequest $request The validated request containing the search parameters
     * @param DescribeFilterAction $describeFilterAction The action to describe the filter conditions
     * @return View The index view populated with the list of visits and filter conditions
     */
    public function search(SearchVisitsRequest $request, DescribeFilterAction $describeFilterAction): View
    {
        try {
            $searchDateRange = $request->validated();
            $searchVisitDTO = new GetVisitsByDateDTO(
                Carbon::createFromFormat('Y-m-d', $searchDateRange['search']['from']),
                Carbon::createFromFormat('Y-m-d', $searchDateRange['search']['to']),
                10
            );

            $return = view('visit.index', [
                'visits' => $this->visitService->getVisitsByDate($searchVisitDTO),
                'filterCondition' => $describeFilterAction($searchDateRange),
                'searchDateRange' => $searchDateRange
            ]);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            $return = redirect()->route('visits.index')->withErrors('Ошибка валидации. Даты имеют неверный формат');
        }

        return $return;
    }

    /**
     * Create a new visit and redirect to the appropriate route.
     *
     * @param CreateNewVisitRequest $request The validated request containing the new visit data
     * @return RedirectResponse A redirect to the show page of the pet related to the visit
     */
    public function create(CreateNewVisitRequest $request): RedirectResponse
    {
        $validatedRequest = $request->validated();
        $redirectErrorRoute = 'pets.show';
        $redirectSuccessRoute = 'pets.show';

        $successMessage = 'Новый прием успешно создан.';
        $errorMessage = 'Ошибка при создании приема. Перезагрузите страницу и попробуйте снова.';

        $newVisit = $this->visitService->createVisit($request->toDTO());

        if (!empty($newVisit)) {
            return redirect()
                ->route($redirectSuccessRoute, ['id' => $newVisit->pet_id])
                ->with('success', $successMessage);
        } else {
            return redirect()
                ->route($redirectErrorRoute, ['id' => $validatedRequest['visit']['pet_id']])
                ->withErrors($errorMessage)
                ->withInput();
        }
    }

    /**
     * Display the edit view for a specific visit.
     *
     * @param int $id The ID of the visit to be edited
     * @return View The edit view populated with the visit data
     */
    public function edit(int $id): View
    {
        return view('visit.edit', [
            'visit' => $this->visitService->getVisitByID($id)
        ]);
    }

    /**
     * Update an existing visit and redirect to the edit view.
     *
     * @param EditExistingVisitRequest $request The validated request containing the updated visit data
     * @param int $id The ID of the visit to be updated
     * @return RedirectResponse A redirect to the edit page of the updated visit
     */
    public function update(EditExistingVisitRequest $request, int $id): RedirectResponse
    {
        $successMessage = 'Прием успешно изменен!';
        $errorMessage = 'Произошла ошибка обновления приема, обновите страницу и попробуйте снова.';

        $redirect = redirect()->route('visits.edit', ['id' => $id]);

        if ($this->visitService->updateVisit($request->toDTO())) {
            $redirect->with('success', $successMessage);
        } else {
            $redirect->withErrors($errorMessage)->withInput();
        }

        return $redirect;
    }
}
