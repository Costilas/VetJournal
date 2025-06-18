<?php

use App\Models\Pet;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

const DATE_FORMAT = 'Y-m-d H:i:s';

uses()->beforeEach(function () {
    $this->seed(\Database\Seeders\CastrationConditionSeeder::class);
    $this->seed(\Database\Seeders\GenderSeeder::class);
    $this->seed(\Database\Seeders\KindSeeder::class);
})->in(__DIR__);

test('Index page validation', function () {
    $visits = [];
    $dateToday = getBaseDate();

    foreach ([11, 12, 13] as $hours) {
        $date = $dateToday->copy()->setTime($hours, 0)->format(DATE_FORMAT);

        $visit = Visit::factory()->create([
            'visit_date' => $date,
        ]);

        $visits[] = $visit;
    }

    $this->assertDatabaseCount('visits', count($visits));

    $response = asUser()
        ->get('/visits')
        ->assertStatus(200)
        ->assertViewIs('visit.index');

    foreach ($visits as $visit) {
        $response->assertViewHas('visits', fn(LengthAwarePaginator $collection) => $collection->contains($visit));
    }

    $response = asAdmin()
        ->get('/visits')
        ->assertStatus(200)
        ->assertViewIs('visit.index');

    foreach ($visits as $visit) {
        $response->assertViewHas('visits', fn(LengthAwarePaginator $collection) => $collection->contains($visit));
    }
});

test('Index page search process fails with future dates', function () {

    $dateToday = getBaseDate();
    $invalidSearchDate = $dateToday->copy()->addDay();

    $httpParameters = [
        'search' => [
            'from' => $dateToday->toDateString(),
            'to' => $invalidSearchDate->toDateString(),
        ]
    ];

    asUser()->get('/visits/search?' . http_build_query($httpParameters))
        ->assertStatus(302)
        ->assertRedirect('/visits')
        ->assertSessionHasErrors(['search.to']);
});

test('Index page search process validation', function () {
    $visits = [];
    $baseDate = getBaseDate();

    foreach ([11, 12, 13] as $hours) {
        $dateToday = $baseDate->copy()->setTime($hours, 0)->format(DATE_FORMAT);
        $datePrevious = $baseDate->copy()->subDays()->setTime($hours, 0)->format(DATE_FORMAT);

        foreach ([$dateToday, $datePrevious] as $date) {
            $visit = Visit::factory()->create([
                'visit_date' => $date,
            ]);

            $visits[] = $visit;
        }
    }

    $httpParameters = http_build_query([
        'search' => [
            'from' => $baseDate->copy()->subDays()->toDateString(),
            'to' => $baseDate->copy()->toDateString(),
        ]
    ]);

    $response = asUser(true)
        ->get('/visits/search?' . $httpParameters)
        ->assertStatus(200);

    foreach ($visits as $visit) {
        $response->assertViewHas('visits', fn(LengthAwarePaginator $collection) => $collection->contains($visit));
    }
});

test('Create new visit validation', function () {
    $pet = Pet::factory()->create();
    $user = User::factory()->create();

    $validData = [
        'visit' => [
            'weight' => '12.345',
            'temperature' => '36.7',
            'pre_diagnosis' => 'Test pre diagnosis',
            'visit_info' => 'Test visit info',
            'treatment' => 'Test treatment',
            'visit_date' => Carbon::now()->subHour()->format('Y-m-d H:i:s'),
            'pet_id' => $pet->id,
            'user_id' => $user->id,
        ],
    ];

    asUser(true)
        ->post("visits/create", $validData)
        ->assertStatus(200);

    $this->assertDatabaseCount('visits', 1);


});


test('Update existing visit validation', function () {
    $visit = Visit::factory()->create();
    $validData = [
        'visit' => [
            'weight' => '12.345',
            'temperature' => '36.7',
            'pre_diagnosis' => 'Общий осмотр: без отклонений',
            'visit_info' => 'Пациент активен, аппетит сохранён.',
            'treatment' => 'Витамины и антибиотики по схеме.',
            'user_id' => 1,
        ],
    ];

    $this->assertDatabaseCount('visits', 1);

    asUser(true)->post("visits/$visit->id/update", $validData)->assertStatus(200);

    $this->assertDatabaseCount('visits', 1);

    $editedVisit = Visit::find($visit->id);

    $this->assertEquals($visit->id, $editedVisit->id);
    $this->assertEquals($editedVisit->weight, floatval($validData['visit']['weight']));
    $this->assertEquals($editedVisit->temperature, floatval($validData['visit']['temperature']));
    $this->assertEquals($editedVisit->pre_diagnosis, $validData['visit']['pre_diagnosis']);
    $this->assertEquals($editedVisit->visit_info, $validData['visit']['visit_info']);
    $this->assertEquals($editedVisit->treatment, $validData['visit']['treatment']);
    $this->assertEquals($editedVisit->user_id, $validData['visit']['user_id']);
});
