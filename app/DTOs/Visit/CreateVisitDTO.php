<?php

namespace App\DTOs\Visit;

use Carbon\Carbon;

final class CreateVisitDTO
{
    public function __construct(
        public readonly int $pet_id,
        public readonly int $user_id,
        public readonly string $visit_date,
        public readonly string $weight,
        public readonly string $temperature,
        public readonly string $pre_diagnosis,
        public readonly string $visit_info,
        public readonly string $treatment,
    ) {}

    public function toArray(): array
    {
        return [
            'pet_id' => $this->pet_id,
            'user_id' => $this->user_id,
            'visit_date' => $this->visit_date,
            'weight' => $this->weight,
            'temperature' => $this->temperature,
            'pre_diagnosis' => $this->pre_diagnosis,
            'visit_info' => $this->visit_info,
            'treatment' => $this->treatment,
        ];
    }
}
