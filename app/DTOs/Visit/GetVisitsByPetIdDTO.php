<?php

namespace App\DTOs\Visit;

use App\Models\Pet;

class GetVisitsByPetIdDTO
{
    public function __construct(
        public readonly Pet $pet,
        public readonly int $paginationLimit,
    )
    {
        if ($paginationLimit <= 0) {
            throw new \InvalidArgumentException('Pagination limit must be greater than 0');
        }

        if (empty($pet->id)) {
            throw new \InvalidArgumentException('Pet ID is empty');
        }
    }
}
