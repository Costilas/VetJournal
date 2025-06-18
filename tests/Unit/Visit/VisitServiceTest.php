<?php

use App\DTOs\Visit\CreateVisitDTO;
use App\DTOs\Visit\SearchPetVisitsDTO;
use App\DTOs\Visit\SearchVisitsDTO;
use App\DTOs\Visit\UpdateVisitDTO;
use App\Models\Pet;
use App\Models\User;
use App\Models\Visit;
use App\Services\Visit\VisitService;
use Carbon\Carbon;
use Database\Seeders\CastrationConditionSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\KindSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

uses()->beforeEach(function (){
    $this->seed(CastrationConditionSeeder::class);
    $this->seed(GenderSeeder::class);
    $this->seed(KindSeeder::class);
    $this->visitService = App::make(VisitService::class);
})->in(__DIR__);

const VISIT_TABLE_NAME = 'visits';

test('Search by date validation', function () {
    $pet = Pet::factory()->create();
    $user = User::factory()->create();
    $totalVisits = 0;
    $visitDates = [
        '2025-06-01' => ['12:30:00', '12:40:00', '12:50:00'],
        '2025-06-02' => ['13:30:00', '13:40:00'],
        '2025-06-03' => ['14:30:00', '14:40:00', '14:50:00'],
        '2025-06-04' => ['15:30:00'],
        '2025-06-05' => ['16:30:00', '16:40:00', '16:50:00'],
        '2025-06-06' => ['17:30:00'],
    ];

    foreach ($visitDates as $date => $visits) {
        $visitsCount = count($visits);
        $totalVisits += $visitsCount;
        $startDate = Carbon::createFromFormat('Y-m-d', $date);
        $endDate = Carbon::createFromFormat('Y-m-d', $date);

        foreach ($visits as $visitTime) {
            Visit::factory()->create([
                'pet_id' => $pet->id,
                'user_id' => $user->id,
                'visit_date' => $date . ' ' . $visitTime,
            ]);
        }

        $searchVisitDTO = new SearchVisitsDTO(
            $startDate,
            $endDate
        );

        $foundVisits = $this->visitService->searchExistingVisits($searchVisitDTO, 10);

        foreach ($foundVisits as $foundVisit) {
           $this->assertTrue((new Carbon($foundVisit->visit_date))->isBetween($startDate, $endDate), 0);
        }

        $this->assertEquals($foundVisits->total(), $visitsCount);
    }

    $totalFrom = array_key_first($visitDates);
    $totalTo = array_key_last($visitDates);

    $searchVisitDTO = new SearchVisitsDTO(
        Carbon::createFromFormat('Y-m-d', $totalFrom),
        Carbon::createFromFormat('Y-m-d', $totalTo)
    );

    $foundVisitsTotal = $this->visitService->searchExistingVisits($searchVisitDTO, $totalVisits + 10);

    $this->assertEquals($foundVisitsTotal->total(), $totalVisits);
    $this->assertDatabaseCount(VISIT_TABLE_NAME, $foundVisitsTotal->total());
});


test('Search existing visit by id', function () {
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 0);
    $visit = Visit::factory()->create();

    $foundExistingVisit = $this->visitService->getVisitByID($visit->id);

    $this->assertEquals($visit->id, $foundExistingVisit->id);
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 1);

    $this->expectException(ModelNotFoundException::class);
    $this->visitService->getVisitByID(++$visit->id);
});




test('Create new visit', function () {
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 0);
    $pet = Pet::factory()->create();
    $user = User::factory()->create();

    $createVisitDTO = new CreateVisitDTO(
        pet_id: $pet->id,
        user_id: $user->id,
        visit_date: Carbon::createFromFormat('Y-m-d', '2025-06-01'),
        weight: '31',
        temperature: '32',
        pre_diagnosis: 'Test pre diagnosis',
        visit_info: 'Test visit info',
        treatment: 'Test treatment'
    );

    $visit = $this->visitService->createNewVisit($createVisitDTO);

    $this->assertModelExists($visit);
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 1);
});

test('Update existing visit', function () {
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 0);
    $pet = Pet::factory()->create();
    $user = User::factory()->create();

    $attributeValues = [
        'pet_id' => ['before' => $pet->id, 'after' => $pet->id],
        'user_id' => ['before' => $user->id, 'after' => $user->id],
        'visit_date' => ['before' => Carbon::createFromFormat('Y-m-d', '2025-06-01'), 'after' => Carbon::createFromFormat('Y-m-d', '2025-06-01')],
        'weight' => ['before' => '7', 'after' => '8'],
        'temperature' => ['before' => '31', 'after' => '32'],
        'pre_diagnosis' => ['before' => 'Test pre diagnosis', 'after' => 'Test pre diagnosis edited'],
        'visit_info' => ['before' => 'Test visit info', 'after' => 'Test visit info edited'],
        'treatment' => ['before' => 'Test treatment', 'after' => 'Test treatment edited'],
    ];

    $createVisitDTO = new CreateVisitDTO(
        pet_id: $attributeValues['pet_id']['before'],
        user_id: $attributeValues['user_id']['before'],
        visit_date: $attributeValues['visit_date']['before'],
        weight: $attributeValues['weight']['before'],
        temperature: $attributeValues['temperature']['before'],
        pre_diagnosis: $attributeValues['pre_diagnosis']['before'],
        visit_info: $attributeValues['visit_info']['before'],
        treatment: $attributeValues['treatment']['before'],
    );

    $visit = $this->visitService->createNewVisit($createVisitDTO);

    $this->assertModelExists($visit);
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 1);

    $updateVisitDTO = new UpdateVisitDTO(
        id: $visit->id,
        user_id: $user->id,
        weight: $attributeValues['weight']['after'],
        temperature: $attributeValues['temperature']['after'],
        pre_diagnosis: $attributeValues['pre_diagnosis']['after'],
        visit_info: $attributeValues['visit_info']['after'],
        treatment: $attributeValues['treatment']['after'],
    );

    $this->assertTrue($this->visitService->updateExistingVisit($updateVisitDTO));
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 1);

    $editedVisit = $this->visitService->getVisitByID($visit->id);

    foreach ($attributeValues as $attribute => $value) {
        $this->assertEquals($value['after'], $editedVisit->$attribute);
    }
});


test('Search pet visits', function () {
    $pet = Pet::factory()->create();
    $user = User::factory()->create();
    $visitDates = ['2025-06-01 10:50:30', '2025-06-02 12:00:00', '2025-06-03 13:00:00'];
    $visitsCount = count($visitDates);

    foreach ($visitDates as $visitDate) {
        Visit::factory()->create([
            'pet_id' => $pet->id,
            'user_id' => $user->id,
            'visit_date' => $visitDate,
        ]);
    }

    $this->assertDatabaseCount(VISIT_TABLE_NAME, $visitsCount);

    foreach ($visitDates as $visitDate) {
        $searchAllPetVisitDTO = new SearchPetVisitsDTO(
            Carbon::createFromFormat('Y-m-d H:i:s', $visitDate),
            Carbon::createFromFormat('Y-m-d H:i:s', $visitDate),
            $pet,
        );

        $petVisits = $this->visitService->searchExistingPetVisits($searchAllPetVisitDTO, $visitsCount);

        $this->assertCount(1, $petVisits);
    }

    $searchAllPetVisitDTO = new SearchPetVisitsDTO(
        Carbon::createFromFormat('Y-m-d H:i:s', $visitDates[0]),
        Carbon::createFromFormat('Y-m-d H:i:s', $visitDates[array_key_last($visitDates)]),
        $pet,
    );

    $petVisits = $this->visitService->searchExistingPetVisits($searchAllPetVisitDTO, $visitsCount);

    $this->assertCount($visitsCount, $petVisits);
});


test('Validates mutator/accessor for creating visit data', function () {
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 0);

    $pet = Pet::factory()->create();
    $user = User::factory()->create();
    $correctWeightValues = ['raw' => '7.4', 'db_stored' => 7400, 'output' => 7.4];
    $correctTempratureValues = ['raw' => '32,2', 'db_stored' => 322, 'output' => 32.2];
    $createVisitDTO = new CreateVisitDTO(
        pet_id: $pet->id,
        user_id: $user->id,
        visit_date: Carbon::createFromFormat('Y-m-d', '2025-06-01'),
        weight: $correctWeightValues['raw'],
        temperature: $correctTempratureValues['raw'],
        pre_diagnosis: 'Test pre diagnosis',
        visit_info: 'Test pre visit_info',
        treatment: 'Test pre treatment',
    );

    $visit = $this->visitService->createNewVisit($createVisitDTO);
    $rawVisit = DB::table(VISIT_TABLE_NAME)
        ->selectRaw('weight, temperature')
        ->where('id', $visit->id)
        ->get()
        ->first();

    $this->assertDatabaseCount(VISIT_TABLE_NAME, 1);
    $this->assertModelExists($visit);
    $this->assertEquals($correctWeightValues['db_stored'], $rawVisit->weight);
    $this->assertEquals($correctTempratureValues['db_stored'], $rawVisit->temperature);
    $this->assertEquals($correctWeightValues['output'], $visit->weight);
    $this->assertEquals($correctTempratureValues['output'], $visit->temperature);
});

test('Validates mutator/accessor for editing visit data', function () {
    $this->assertDatabaseCount(VISIT_TABLE_NAME, 0);

    $visit = Visit::factory()->create();
    $correctWeightValues = ['raw' => '7.4', 'db_stored' => 7400, 'output' => 7.4];
    $correctTempratureValues = ['raw' => '32,2', 'db_stored' => 322, 'output' => 32.2];

    $updateVisitDTO = new UpdateVisitDTO(
        id: $visit->id,
        user_id: $visit->user_id,
        weight: $correctWeightValues['raw'],
        temperature: $correctTempratureValues['raw'],
        pre_diagnosis: 'Test pre diagnosis',
        visit_info: 'Test pre visit_info',
        treatment: 'Test pre treatment',
    );

    $this->visitService->updateExistingVisit($updateVisitDTO);
    $rawVisit = DB::table(VISIT_TABLE_NAME)
        ->selectRaw('weight, temperature')
        ->where('id', $visit->id)
        ->get()
        ->first();
    $updatedVisit = $this->visitService->getVisitByID($visit->id);

    $this->assertDatabaseCount(VISIT_TABLE_NAME, 1);
    $this->assertEquals($correctWeightValues['db_stored'], $rawVisit->weight);
    $this->assertEquals($correctTempratureValues['db_stored'], $rawVisit->temperature);
    $this->assertEquals($correctWeightValues['output'], $updatedVisit->weight);
    $this->assertEquals($correctTempratureValues['output'], $updatedVisit->temperature);
});
