<?php

use App\DTOs\Visit\SearchPetVisitsDTO;
use App\Models\Pet;
use Carbon\Carbon;

test('SearchPetVisitsDTO creates correctly and orders dates', function () {
    $pet = new Pet();
    $pet->id = 1;

    $dto = new SearchPetVisitsDTO(
        from: Carbon::parse('2025-06-06'),
        to: Carbon::parse('2025-06-16'),
        pet: $pet
    );

    expect($dto->from())->toBe('2025-06-06')
        ->and($dto->to())->toBe('2025-06-16')
        ->and($dto->ordered())->toBe([
            Carbon::parse('2025-06-06'),
            Carbon::parse('2025-06-16'),
        ]);
});

test('SearchPetVisitsDTO reverses date order when from > to', function () {
    $pet = new Pet();
    $pet->id = 1;

    $dto = new SearchPetVisitsDTO(
        from: Carbon::parse('2025-06-16'),
        to: Carbon::parse('2025-06-06'),
        pet: $pet
    );

    expect($dto->ordered())->toBe([
        Carbon::parse('2025-06-06'),
        Carbon::parse('2025-06-16'),
    ]);
});

test('SearchPetVisitsDTO throws when pet has no id', function () {
    $this->expectException(\http\Exception\InvalidArgumentException::class);

    $pet = new Pet();

    new SearchPetVisitsDTO(
        from: Carbon::parse('2025-06-06'),
        to: Carbon::parse('2025-06-16'),
        pet: $pet
    );
});

