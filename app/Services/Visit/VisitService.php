<?php

namespace App\Services\Visit;

use App\DTOs\Visit\SearchPetVisitsDTO;
use App\Models\Visit;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use App\DTOs\Visit\CreateVisitDTO;
use App\DTOs\Visit\SearchVisitsDTO;
use App\DTOs\Visit\UpdateVisitDTO;

class VisitService
{
    /**
     * Retrieve a Visit by its ID.
     *
     * @param int $id The ID of the Visit to retrieve
     * @return Visit The Visit model corresponding to the given ID
     * @throws ModelNotFoundException If the Visit model is not found
     */
    public function getVisitByID(int $id): Visit
    {
        return Visit::findOrFail($id);
    }

    /**
     * Retrieve visits of a specific pet with optional filtering.
     *
     * @param SearchPetVisitsDTO $searchVisitsDTO
     * @param int $paginationLimit Number of visits per page
     * @return LengthAwarePaginator The paginated visits of the pet
     */
    public function searchExistingPetVisits(
        SearchPetVisitsDTO $searchVisitsDTO,
        int $paginationLimit
    ): LengthAwarePaginator {
        return Visit::filter(['pet' => $searchVisitsDTO->pet->id,'search'=> $searchVisitsDTO->ordered()])
            ->with('user')
            ->orderBy('id', 'DESC')
            ->paginate($paginationLimit)
            ->withQueryString();
    }

    /**
     * Search for existing visits based on the provided DTO and pagination limit.
     *
     * @param SearchVisitsDTO $searchVisitsDTO The Data Transfer Object containing the search parameters
     * @param int $paginationLimit The number of results to display per page
     * @return LengthAwarePaginator A paginator for the visits that match the search criteria
     */
    public function searchExistingVisits(SearchVisitsDTO $searchVisitsDTO, int $paginationLimit): LengthAwarePaginator
    {
        return Visit::filter([
            'search'=> $searchVisitsDTO->ordered()
        ])
            ->with('pet.owner', 'user')
            ->orderBy('id', 'DESC')
            ->paginate($paginationLimit)
            ->withQueryString();
    }

    /**
     * Create a new Visit based on the validated request data.
     *
     * @param CreateVisitDTO $dto
     * @return Visit|null The newly created Visit model or null if creation failed
     */
    public function createNewVisit(CreateVisitDTO $dto): ?Visit
    {
        try {
            $visit = Visit::create($dto->toArray());
        } catch (Exception $e){
            Log::debug($e->getMessage());
            $visit = null;
        }

        return $visit;
    }

    /**
     * Update an existing Visit based on the validated request data.
     *
     * @param UpdateVisitDTO $dto
     * @return bool True if the update was successful, false otherwise
     */
    public function updateExistingVisit(UpdateVisitDTO $dto): bool
    {
        try {
            $visit = Visit::findOrFail($dto->id);

            return $visit->update($dto->toArray());
        } catch (Exception $e) {
            Log::warning("Визит с переданным ID не был найден.");

            return false;
        }
    }
}
