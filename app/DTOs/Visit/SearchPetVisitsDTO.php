<?php

namespace App\DTOs\Visit;

use App\Models\Pet;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;

final class SearchPetVisitsDTO
{
    private const DATEFORMAT = 'Y-m-d';

    public function __construct(
        public readonly Carbon $from,
        public readonly Carbon $to,
        public readonly Pet $pet,
    ) {
        if (empty($pet->id)) {
            throw new InvalidArgumentException('Питомец с таким ID не найдет');
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
