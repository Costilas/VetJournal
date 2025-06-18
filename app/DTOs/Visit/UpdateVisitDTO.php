<?php

namespace App\DTOs\Visit;

final class UpdateVisitDTO
{
    public function __construct(
        public int $id,
        public readonly int $user_id,
        public readonly string $weight,
        public readonly string $temperature,
        public readonly string $pre_diagnosis,
        public readonly string $visit_info,
        public readonly string $treatment,
    ) {}

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'weight' => $this->weight,
            'temperature' => $this->temperature,
            'pre_diagnosis' => $this->pre_diagnosis,
            'visit_info' => $this->visit_info,
            'treatment' => $this->treatment,
        ];
    }
}
