<?php

use App\DTOs\Visit\GetPetVisitsByDateDTO;
use App\Models\Pet;
use Carbon\Carbon;

test('GetPetVisitsByDateDTO creates correctly and orders dates', function () {
    $pet = new Pet();
    $pet->id = 1;
    $from = Carbon::parse('2025-06-06');
    $to = Carbon::parse('2025-06-16');
    $dto = new GetPetVisitsByDateDTO(
        from: $from,
        to: $to,
        pet: $pet,
        paginationLimit: 5
    );

    expect($dto->from())->toBe('2025-06-06')
        ->and($dto->to())->toBe('2025-06-16')
        ->and($dto->ordered())->toBe([
            $from,
            $to,
        ]);
});

test('GetPetVisitsByDateDTO reverses date order when from > to', function () {
    $pet = new Pet();
    $pet->id = 1;
    $from = Carbon::parse('2025-06-06');
    $to = Carbon::parse('2025-06-16');
    $dto = new GetPetVisitsByDateDTO(
        from: $to,
        to: $from,
        pet: $pet,
        paginationLimit: 5
    );

    expect($dto->ordered())->toBe([
        $from,
        $to,
    ]);
});

test('GetPetVisitsByDateDTO throws when pet has no id', function () {
    $this->expectException(InvalidArgumentException::class);

    $pet = new Pet();

    new GetPetVisitsByDateDTO(
        from: Carbon::parse('2025-06-06'),
        to: Carbon::parse('2025-06-16'),
        pet: $pet,
        paginationLimit: 5
    );
});

