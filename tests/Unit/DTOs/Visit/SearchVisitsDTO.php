<?php

use App\DTOs\Visit\SearchVisitsDTO;
use Carbon\Carbon;

test('SearchVisitsDTO creates correctly with valid dates', function () {
    $dto = new SearchVisitsDTO(
        from: Carbon::parse('2025-06-06'),
        to: Carbon::parse('2025-06-16')
    );

    expect($dto->from())->toBe('2025-06-06')
        ->and($dto->to())->toBe('2025-06-16')
        ->and($dto->ordered())->toBe([
            Carbon::parse('2025-06-06'),
            Carbon::parse('2025-06-16'),
        ]);
});

test('SearchVisitsDTO reverses dates when from > to', function () {
    $dto = new SearchVisitsDTO(
        from: Carbon::parse('2025-06-16'),
        to: Carbon::parse('2025-06-06')
    );

    expect($dto->ordered())->toBe([
        Carbon::parse('2025-06-06'),
        Carbon::parse('2025-06-16'),
    ]);
});

