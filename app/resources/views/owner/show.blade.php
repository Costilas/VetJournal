@extends('layouts.body.app.layout')

@section('title') Владелец::{{$owner->last_name}} @endsection

@section('content')
    <div class="owner_info">
        <div class="owner_credentials">
            {{$owner->last_name}}{{$owner->patronymic}}{{$owner->name}}
            {{$owner->address}}
            {{$owner->phone}}
            Дата регистрации: {{$owner->created_at}}
            {{$owner->address}}
        </div>
        <div class="m-3 text-center">
            <p>
                <a class="btn btn-success" data-bs-toggle="collapse" href="#newPet" role="button" aria-expanded="false"
                   aria-controls="newPet">
                    <i class="bi bi-journal-plus"></i> Добавить питомца
                </a>
            </p>
            <div class="collapse" id="newPet">
                <div class="card card-body">
                    @include('owner.pet.add')
                </div>
            </div>
        </div>

        <div class="owner_pet_list">
            <div class="row">
            @foreach($owner->pets as $pet)
                    <div class="col-sm-6 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"> Кличка: {{$pet->pet_name}} </h5>
                                <p class="card-text"> Вид: {{$pet->kind->kind}} </p>
                                <p class="card-text"> Пол: {{$pet->gender->gender}} </p>
                                <a href="{{route('pet.show', ['id'=>$pet->id])}}" class="btn btn-primary">К питомцу</a>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
