<?php

use App\Models\Visit;
use Illuminate\Pagination\LengthAwarePaginator;

const DATE_FORMAT = 'Y-m-d H:i:s';

uses()->beforeEach(function (){
    $this->seed(\Database\Seeders\CastrationConditionSeeder::class);
    $this->seed(\Database\Seeders\GenderSeeder::class);
    $this->seed(\Database\Seeders\KindSeeder::class);
})->in(__DIR__);

test('Index page validation', function () {
    $visits = [];
    $dateToday = getBaseDate();

    foreach([11, 12, 13] as $hours) {
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
    $invalidSearchDate= $dateToday->copy()->addDay();

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

    foreach([11, 12, 13] as $hours) {
        $dateToday = $baseDate->copy()->setTime($hours, 0)->format(DATE_FORMAT);
        $datePrevious = $baseDate->copy()->subDays()->setTime($hours, 0)->format(DATE_FORMAT);

        foreach([$dateToday, $datePrevious] as $date) {
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
