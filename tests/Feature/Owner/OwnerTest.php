<?php

use App\Models\Owner;
use App\Models\Pet;

uses()->beforeEach(function (){
    $this->seed(\Database\Seeders\CastrationConditionSeeder::class);
    $this->seed(\Database\Seeders\GenderSeeder::class);
    $this->seed(\Database\Seeders\KindSeeder::class);
})->in(__DIR__);

test('User can create owner with pets', function () {
    asUser()->post('/owners/store', [
        'owner' => [
            'name' => 'Name',
            'patronymic' => 'Patronymic',
            'last_name' => 'Lastname',
            'address' => 'Some address string. Some st.',
            'phone' => getTestPhone(),
            'additional_phone' => '12345',
            'email' => 'test@mail.com',
        ],
        'pets' => [
            [
                'pet_name' => 'PetName',
                'kind_id' => '1',
                'gender_id' => '1',
                'castration_condition_id' => '1',
                'birth' => '10.10.2021',
            ]
        ]
    ]);

    $this->assertDatabaseCount('owners', 1);
    $this->assertDatabaseCount('pets', 1);
});

test('User can attach new pet to existing owner', function () {

    $user = getNewUser();
    $owner = Owner::create([
        'name' => 'Name',
        'patronymic' => 'Patronymic',
        'last_name' => 'Lastname',
        'address' => 'Some address string. Some st.',
        'phone' => getTestPhone(),
        'additional_phone' => '12345',
        'email' => 'test@mail.com',
    ]);
    Pet::create([
        'pet_name' => 'PetName',
        'kind_id' => '1',
        'gender_id' => '1',
        'castration_condition_id' => '1',
        'birth' => '10.10.2021',
        'owner_id' => $owner->id
    ]);

    $response = $this->followingRedirects()->actingAs($user)->post("owners/$owner->id/attach", [
        'pets' => [
            [
                'pet_name' => 'SecondPetName',
                'kind_id' => '1',
                'gender_id' => '1',
                'castration_condition_id' => '1',
                'birth' => '10.10.2021',
            ]
        ]
    ]);

    $owner->load('pets');

    $response->assertStatus(200);
    $this->assertDatabaseCount('owners', 1);
    $this->assertDatabaseCount('pets', 2);
    $this->assertEquals(2, $owner->pets->count());
});

test('User can read existing owner detail page', function () {

    $owner = Owner::create([
        'name' => 'Name',
        'patronymic' => 'Patronymic',
        'last_name' => 'Lastname',
        'address' => 'Some address string. Some st.',
        'phone' => getTestPhone(),
        'additional_phone' => '12345',
        'email' => 'test@mail.com',
    ]);
    $pet = Pet::create([
        'pet_name' => 'PetName',
        'kind_id' => '1',
        'gender_id' => '1',
        'castration_condition_id' => '1',
        'birth' => '10.10.2021',
        'owner_id' => $owner->id
    ]);

    $response = asUser(true)->get("owners/$owner->id/show");

    $response->assertStatus(200);
    $response->assertViewHas('owner', function (Owner $owner) {
        return $owner->email === 'test@mail.com';
    });
    $response->assertSee($pet->pet_name);
});

test('User can edit existing owner data', function () {

    $newUserData = [
        'name' => 'NewName',
        'patronymic' => 'NewPatronymic',
        'last_name' => 'NewLastname',
        'address' => 'NewAddress',
        'additional_phone' => '123456',
        'email' => 'newtest@mail.com',
    ];

    $owner = Owner::create([
        'name' => 'Name',
        'patronymic' => 'Patronymic',
        'last_name' => 'Lastname',
        'address' => 'Some address string. Some st.',
        'phone' => getTestPhone(),
        'additional_phone' => '12345',
        'email' => 'test@mail.com',
    ]);

    $response = asUser(true)->post("owners/$owner->id/update", $newUserData);

    $response->assertStatus(200);

    $updatedOwner = Owner::find($owner->id);

    foreach ($newUserData as $fieldName => $fieldValue) {
        $this->assertEquals($updatedOwner->$fieldName, $fieldValue);
    }
});

test('User can search existing owner by different owner data', function (string $fieldName, string $getParameterWithPartOfData) {
    $owner = Owner::create([
        'name' => 'Name',
        'patronymic' => 'Patronymic',
        'last_name' => 'Lastname',
        'address' => 'Some address string. Some st.',
        'phone' => getTestPhone(),
        'additional_phone' => '12345',
        'email' => 'test1@mail.com',
    ]);
   $pet = Pet::create([
        'pet_name' => 'PetName',
        'kind_id' => '1',
        'gender_id' => '1',
        'castration_condition_id' => '1',
        'birth' => '10.10.2021',
        'owner_id' => $owner->id
    ]);

    $this->assertDatabaseCount('owners', 1);
    $this->assertDatabaseCount('pets', 1);

    $response = asUser(true)->get('owners/search?' . $getParameterWithPartOfData);

    if($fieldName === 'pets') {
        $response->assertSee($pet->$fieldName);
    } else {
        $response->assertSee($owner->$fieldName);
    }

})->with([
    ['email', 'email=test1'],
    ['name', 'name=Na'],
    ['patronymic', 'patronymic=P'],
    ['last_name', 'lastName=Las'],
    ['additional_phone', 'additionalPhone=123'],
    ['pets', 'pets=PetN'],
]);
