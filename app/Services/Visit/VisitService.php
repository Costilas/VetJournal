<?php

namespace App\Services\Visit;

use App\DTOs\Visit\GetVisitsByPetIdDTO;
use App\DTOs\Visit\GetPetVisitsByDateDTO;
use App\Models\Visit;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use App\DTOs\Visit\CreateVisitDTO;
use App\DTOs\Visit\GetVisitsByDateDTO;
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

    public function getVisitsByPetID(GetVisitsByPetIdDTO $dto): LengthAwarePaginator
    {
        return Visit::where('pet_id', $dto->pet->id)->with('user')
            ->latest('visit_date')
            ->paginate($dto->paginationLimit)
            ->withQueryString();
    }

    /**
     * Retrieve visits of a specific pet with optional filtering.
     *
     * @param GetPetVisitsByDateDTO $dto
     * @return LengthAwarePaginator The paginated visits of the pet
     */
    public function getPetVisitsByDate(GetPetVisitsByDateDTO $dto): LengthAwarePaginator
    {
        return Visit::filter(['pet' => $dto->pet->id, 'search' => $dto->ordered()])
            ->with('user')
            ->orderBy('id', 'DESC')
            ->paginate($dto->paginationLimit)
            ->withQueryString();
    }

    /**
     * Search for existing visits based on the provided DTO and pagination limit.
     *
     * @param GetVisitsByDateDTO $dto
     * @return LengthAwarePaginator A paginator for the visits that match the search criteria
     */
    public function getVisitsByDate(GetVisitsByDateDTO $dto): LengthAwarePaginator
    {
        return Visit::filter([
            'search' => $dto->ordered()
        ])
            ->with('pet.owner', 'user')
            ->orderBy('id', 'DESC')
            ->paginate($dto->paginationLimit)
            ->withQueryString();
    }

    /**
     * Create a new Visit based on the validated request data.
     *
     * @param CreateVisitDTO $dto
     * @return Visit|null The newly created Visit model or null if creation failed
     */
    public function createVisit(CreateVisitDTO $dto): ?Visit
    {
        try {
            $visit = Visit::create($dto->toArray());
        } catch (Exception $e) {
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
    public function updateVisit(UpdateVisitDTO $dto): bool
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
