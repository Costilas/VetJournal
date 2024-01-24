<?php

namespace App\DTOs\Visit;

class SearchVisitsDTO
{
    private string $from;
    private string $to;

    public function __construct(array $searchDateRange)
    {
        $this->from = $searchDateRange['search']['from'];
        $this->to = $searchDateRange['search']['to'];
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }
}
