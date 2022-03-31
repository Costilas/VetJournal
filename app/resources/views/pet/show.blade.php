@extends('layouts.layout')

@section('title') Пациент::{{$pet->pet_name}} ({{$pet->owner->last_name}}) @endsection

@section('content')
    <h2 class="text-center m-5">Карточка питомца: {{$pet->pet_name}}(ID:{{$pet->id}})</h2>
    <div class="info_block">
        <div class="pet_info d-flex justify-content-center">
            <div class="card" style="width: 50%;">
                <div class="card-body">
                    <h5 class="card-title text-center">Кличка: <strong>{{$pet->pet_name}}</strong></h5>
                    <p class="card-text">ID: <strong>{{$pet->id}}</strong></p>
                    <p class="card-text">Вид: <strong>{{$pet->kind->kind}}</strong></p>
                    <p class="card-text">Пол: <strong>{{$pet->gender->gender}}</strong></p>
                    <p class="card-text">Дата рождения <strong>{{$pet->birthDateFormat()}}</strong>
                        (<i>{{$pet->countYears()}} лет</i>)</p>
                    <p class="card-text"></p>
                </div>
            </div>
            <div class="card" style="width: 50%;">
                <div class="card-body">
                    <p class="text-center"> Владелец: </p>
                    <h5 class="card-title">ФИО:
                        <strong>{{$pet->owner->last_name}} {{$pet->owner->name}} {{$pet->owner->patronymic}}</strong>
                    </h5>
                    <p class="card-text"> Адрес: <strong>{{$pet->owner->address}}</strong></p>
                    <p class="card-text"> Телефон: <strong>{{$pet->owner->phone}}</strong></p>
                    <div class="pet_badge_block">
                        <p class="card-text">Питомцы: {{count($pet->owner->pets)}}</p>
                        @foreach($pet->owner->pets as $ownerOtherPets)
                            <a class="btn  btn-primary @if($ownerOtherPets->id===$pet->id) disabled @endif pet_badge"
                               href="{{route('pet.show', ['id'=>$ownerOtherPets->id])}}">{{$ownerOtherPets->pet_name}}</a>
                        @endforeach
                    </div>
                    <a href="{{route('owner.show', ['id'=>$pet->owner->id])}}" class="btn btn-primary mt-auto"><i
                            class="bi bi-file-earmark-person"></i> Профиль владельца</a>
                </div>
            </div>
        </div>
    </div>
    <div class="visit_block">
        @include('pet.visit.list')
    </div>
@endsection
