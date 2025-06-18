<?php

use App\DTOs\Visit\CreateVisitDTO;

test('CreateVisitDTO creates correctly with valid data', function () {
    $dto = new CreateVisitDTO(
        pet_id: 1,
        user_id: 2,
        visit_date: '2025-06-16',
        weight: '4.5',
        temperature: '38.2',
        pre_diagnosis: 'Cough',
        visit_info: 'Routine check',
        treatment: 'Vitamin injection',
    );

    expect($dto->toArray())->toBe([
        'pet_id' => 1,
        'user_id' => 2,
        'visit_date' => '2025-06-16',
        'weight' => '4.5',
        'temperature' => '38.2',
        'pre_diagnosis' => 'Cough',
        'visit_info' => 'Routine check',
        'treatment' => 'Vitamin injection',
    ]);
});

test('CreateVisitDTO fails with invalid pet_id type', function () {
    $this->expectException(TypeError::class);

    new CreateVisitDTO(
        pet_id: 'not-int',
        user_id: 2,
        visit_date: '2025-06-16',
        weight: '4.5',
        temperature: '38.2',
        pre_diagnosis: 'Cough',
        visit_info: 'Routine check',
        treatment: 'Vitamin injection',
    );
});

