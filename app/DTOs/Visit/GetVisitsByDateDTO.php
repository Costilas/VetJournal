<?php

namespace App\DTOs\Visit;

use Carbon\Carbon;

final class GetVisitsByDateDTO
{
    private const DATEFORMAT = 'Y-m-d';

    public function __construct(
        readonly Carbon $from,
        readonly Carbon $to,
        readonly int    $paginationLimit
    )
    {
        if ($paginationLimit <= 0) {
            throw new \InvalidArgumentException('Pagination limit must be greater than 0');
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
