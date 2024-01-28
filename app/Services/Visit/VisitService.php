<?php

namespace App\Services\Visit;

use App\DTOs\Visit\SearchVisitsDTO;
use App\Http\Requests\Visit\CreateNewVisitRequest;
use App\Http\Requests\Visit\EditExistingVisitRequest;
use App\Models\Visit;
use Illuminate\Support\Facades\Log;

class VisitService
{
    /**
     * Retrieve a Visit by its ID.
     *
     * @param int $id The ID of the Visit to retrieve
     * @return Visit The Visit model corresponding to the given ID
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the Visit model is not found
     */
    public function getVisit(int $id): Visit
    {
        return Visit::findOrFail($id);
    }

    /**
     * Search for existing visits based on the provided DTO and pagination limit.
     *
     * @param SearchVisitsDTO $searchVisitsDTO The Data Transfer Object containing the search parameters
     * @param int $paginationLimit The number of results to display per page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator A paginator for the visits that match the search criteria
     */
    public function searchExistingVisits(SearchVisitsDTO $searchVisitsDTO, int $paginationLimit)
    {
        $filterData = [
            'search'=> [
                'from'=>$searchVisitsDTO->getFrom(),
                'to'=>$searchVisitsDTO->getTo()
            ]
        ];

        return Visit::filter($filterData)
            ->with('pet.owner', 'user')
            ->orderBy('id', 'DESC')
            ->paginate($paginationLimit)
            ->withQueryString();
    }

    /**
     * Create a new Visit based on the validated request data.
     *
     * @param CreateNewVisitRequest $createNewVisitRequest The validated request containing the new Visit data
     * @return Visit|null The newly created Visit model or null if creation failed
     */
    public function createNewVisit(CreateNewVisitRequest $createNewVisitRequest): ?Visit
    {
        try {
            $validatedRequest = $createNewVisitRequest->validated();
            $validatedRequest['visit']['weight'] = Visit::weightNormalize($validatedRequest['visit']['weight']);
            $validatedRequest['visit']['temperature'] = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
            $visit = Visit::create($validatedRequest['visit']);
        } catch (\Exception $e){
            Log::debug($e->getMessage());
            $visit = null;
        }

        return $visit;
    }

    /**
     * Update an existing Visit based on the validated request data.
     *
     * @param EditExistingVisitRequest $editExistingVisitRequest The validated request containing the updated Visit data
     * @param int $id The ID of the Visit to update
     * @return bool True if the update was successful, false otherwise
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the Visit model is not found
     */
    public function updateExistingVisit(EditExistingVisitRequest $editExistingVisitRequest, int $id): bool
    {
        $visit = Visit::findOrFail($id);
        $validated = $editExistingVisitRequest->validated();

        if(key_exists('visit', $validated)) {
            $result = $visit->update($validated['visit']);
        } else {
            $result = false;
        }

        return $result;
    }

    /**
     * Prepare numeric data from a string for use in calculations.
     *
     * @param string $string The string to prepare
     * @return float The prepared numeric data
     */
    public static function prepareNumericData(string $string):float
    {
        $prepared = self::stringCleaner($string);

        return self::stringToFloat($prepared);
    }

    /**
     * Remove extra spaces and unwanted characters from a string.
     *
     * @param string $string The string to clean
     * @return string The cleaned string
     */
    private static function stringCleaner(string $string):string
    {
        return trim(str_replace([',', '.'], '.', $string), ' .');
    }

    /**
     * Convert a cleaned string to a float.
     *
     * @param string $string The string to convert
     * @return float The converted float value
     */
    private static function stringToFloat(string $string):float
    {
        return floatval($string);
    }
}
