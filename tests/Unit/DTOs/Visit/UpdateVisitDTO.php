<?php

use App\DTOs\Visit\UpdateVisitDTO;

test('UpdateVisitDTO creates correctly with valid data', function () {
    $dto = new UpdateVisitDTO(
        id: 1,
        user_id: 2,
        weight: '4.7',
        temperature: '37.9',
        pre_diagnosis: 'Sneezing',
        visit_info: 'Follow-up',
        treatment: 'Antibiotics',
    );

    expect($dto->toArray())->toBe([
        'user_id' => 2,
        'weight' => '4.7',
        'temperature' => '37.9',
        'pre_diagnosis' => 'Sneezing',
        'visit_info' => 'Follow-up',
        'treatment' => 'Antibiotics',
    ]);
});

test('UpdateVisitDTO fails with non-integer id', function () {
    $this->expectException(TypeError::class);

    new UpdateVisitDTO(
        id: 'not-int',
        user_id: 2,
        weight: '4.7',
        temperature: '37.9',
        pre_diagnosis: 'Sneezing',
        visit_info: 'Follow-up',
        treatment: 'Antibiotics',
    );
});
