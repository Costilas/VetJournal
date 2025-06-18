<?php

namespace App\DTOs\Visit;

use App\Models\Pet;
use Carbon\Carbon;
use InvalidArgumentException;

final class GetPetVisitsByDateDTO
{
    private const DATEFORMAT = 'Y-m-d';

    public function __construct(
        public readonly Carbon $from,
        public readonly Carbon $to,
        public readonly Pet    $pet,
        public readonly int    $paginationLimit
    )
    {
        if (empty($pet->id)) {
            throw new InvalidArgumentException('Pet ID is empty');
        }

        if ($paginationLimit <= 0) {
            throw new InvalidArgumentException('Pagination limit must be greater than 0');
        }
    }

    public function ordered(): array
    {
        return $this->from->lessThanOrEqualTo($this->to)
            ? [$this->from, $this->to]
            : [$this->to, $this->from];
    }

    public function from(): string
    {
        return $this->from->format(self::DATEFORMAT);
    }

    public function to(): string
    {
        return $this->to->format(self::DATEFORMAT);
    }
}
