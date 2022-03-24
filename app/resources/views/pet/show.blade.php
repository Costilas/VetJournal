@extends('layouts.layout')

@section('title') Пациент::{{$pet->pet_name}} @endsection

@section('content')
    <h2 class="text-center m-5">Карточка питомца: {{$pet->pet_name}}</h2>
        <div class="info_block">
            <div class="pet_info d-flex justify-content-center">
                <div class="card"  style="width: 50%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Кличка: <strong>{{$pet->pet_name}}</strong></h5>
                        <p class="card-text">ID: <strong>{{$pet->id}}</strong></p>
                        <p class="card-text">Пол: <strong>{{$pet->gender->gender}}</strong></p>
                        <p class="card-text">Вид: <strong>{{$pet->kind->kind}}</strong></p>
                        <p class="card-text">Дата рождения <strong>{{date('d-m-Y', strtotime($pet->birth))}}</strong> (<i>{{$pet->countYears()}} лет</i>)</p>
                        <p class="card-text"></p>
                    </div>
                </div>
                <div class="card" style="width: 50%;">
                    <div class="card-body">
                        <p>Владелец: </p>
                        <h5 class="card-title">{{$pet->owner->last_name}} {{$pet->owner->patronymic}} {{$pet->owner->name}}</h5>
                        <p class="card-text">{{$pet->owner->address}}</p>
                        <p class="card-text">{{$pet->owner->phone}}</p>
                        <p class="card-text">Питомцы: {{count($pet->owner->pets)}}</p>
                        <div class="mb-5">
                            @foreach($pet->owner->pets as $ownerPet)
                                <a class="btn badge bg-primary @if($ownerPet->id===$pet->id) disabled @endif" href="{{route('pet.show', ['id'=>$ownerPet->id])}}">{{$ownerPet->pet_name}}</a>
                            @endforeach
                        </div>
                        <a href="#" class="btn btn-primary">Профиль владельца</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-3 text-center">
            <p>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#newVisit" role="button" aria-expanded="false" aria-controls="newVisit">
                    Новый прием
                </a>
            </p>
            <div class="collapse" id="newVisit">
                <div class="card card-body">
                    @include('visit.create')
                </div>
            </div>
        </div>
        <div class="pet_visits_block p-3 text-center">
            @foreach($visits as $visit)
                <div class="m-3">
                    <p>
                        <a class="btn btn-light" data-bs-toggle="collapse" href="#oldVisit{{$visit->id}}" role="button" aria-expanded="false" aria-controls="oldVisit{{$visit->id}}">
                            Дата: {{$visit->dateFormat()}}
                            <br> Вес: {{$visit->weight}}
                            <br> Температура: {{$visit->temperature}}
                            <br> Предварительный диагноз: {{$visit->pre_diagnosis}}
                        </a>
                    </p>
                    <div class="collapse" id="oldVisit{{$visit->id}}">
                        <div class="card card-body">
                            {{$visit->visit_info}}
                        </div>
                    </div>
                </div>
            @endforeach
            {{$visits->links()}}
        </div>

@endsection
