<?php

use App\DTOs\Visit\GetVisitsByPetIdDTO;
use App\Models\Pet;

test('GetVisitsByPetIdDTO creates correctly with valid data', function () {
    $pet = Pet::factory()->create();
    $pagintaionLimit = 10;

    $dto = new GetVisitsByPetIdDTO($pet, $pagintaionLimit);

    $this->assertEquals($pet->id, $dto->pet->id);
    $this->assertEquals($pagintaionLimit, $dto->paginationLimit);
});

test('GetVisitsByPetIdDTO create fails with invalid pet id', function () {

    $this->expectException(InvalidArgumentException::class);
    $pet = new Pet();
    $pagintaionLimit = 10;

    new GetVisitsByPetIdDTO($pet, $pagintaionLimit);
});

test('GetVisitsByPetIdDTO create fails with invalid pagination limit', function () {

    $this->expectException(InvalidArgumentException::class);
    $pet = Pet::factory()->create();;
    $pagintaionLimit = 0;

    new GetVisitsByPetIdDTO($pet, $pagintaionLimit);
});
