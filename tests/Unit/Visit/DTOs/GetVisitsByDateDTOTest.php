<?php

use App\DTOs\Visit\GetVisitsByDateDTO;
use Carbon\Carbon;

test('GetVisitsByDateDTO creates correctly with valid dates', function () {

    $from = Carbon::parse('2025-06-06');
    $to = Carbon::parse('2025-06-16');

    $dto = new GetVisitsByDateDTO(
        from: $from,
        to: $to,
        paginationLimit: 10
    );

    expect($dto->from())->toBe('2025-06-06')
        ->and($dto->to())->toBe('2025-06-16')
        ->and($dto->ordered())->toBe([
            $from,
            $to,
        ]);
});

test('GetVisitsByDateDTO reverses dates when from > to', function () {
    $from = Carbon::parse('2025-06-16');
    $to = Carbon::parse('2025-06-06');
    $dto = new GetVisitsByDateDTO(
        from: $from,
        to: $to,
        paginationLimit: 10
    );

    expect($dto->ordered())->toBe([
        $to,
        $from,
    ]);
});

