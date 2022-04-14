@extends('layouts.body.app.layout')

@section('title') Пациент::{{$pet->pet_name}} ({{$owner->last_name}}) @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="text-center m-5">Пациент: <strong>{{$pet->pet_name}}</strong>({{$owner->last_name}})</h2>
        </div>
    </div>
    <div class="info_block row row-cols-auto justify-content-center">
        <div class="col col-lg-6 col-xl-6 col-md-10 col-sm-12 h-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Кличка: <strong>{{$pet->pet_name}}</strong></h5>
                    <p class="card-text">Вид: <strong>{{$pet->kind->kind}}</strong></p>
                    <p class="card-text">Пол: <strong>{{$pet->gender->gender}}</strong></p>
                    <p class="card-text">Дата рождения: <strong>{{$pet->birthDateFormat()}}</strong></p>
                    <p class="card-text">Возраст: (<i>{{$pet->countYears()}} лет</i>)</p>
                    <p class="card-text"></p>
                    <a href="{{route('pet.edit', ['id'=>$pet->id])}}" class="btn btn-primary mt-auto"><i
                            class="bi bi-file-earmark-person"></i> Редактировать профиль пациента</a>
                </div>
            </div>
        </div>
        <div class="col col-lg-6 col-xl-6 col-md-10 col-sm-12 h-auto">
            <div class="card">
                <div class="card-body">
                    <p class="text-center"> Владелец: </p>
                    <h5 class="card-title">ФИО:
                        <strong>{{$owner->last_name}} {{$owner->name}} {{$owner->patronymic}}</strong>
                    </h5>
                    <p class="card-text"> Адрес: <strong>{{$owner->address}}</strong></p>
                    <p class="card-text"> Телефон: <strong>{{$owner->phone}}</strong></p>
                    <a href="{{route('owner.show', ['id'=>$owner->id])}}" class="btn btn-primary mt-auto"><i
                            class="bi bi-file-earmark-person"></i> Профиль владельца</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1">
        <div class="col-12">
            <div class="actions">
                <div class="m-3 text-center">
                    <a class="btn btn-success" data-bs-toggle="collapse" href="#newVisit" role="button"
                       aria-expanded="false"
                       aria-controls="newVisit m-1">
                        <i class="bi bi-journal-plus"></i> Новый прием
                    </a>
                    <a class="btn btn-warning" data-bs-toggle="collapse" href="#searchVisit" role="button"
                       aria-expanded="false"
                       aria-controls="searchVisit m-1">
                        <i class="bi bi-search"></i> Поиск приемов по дате
                    </a>
                </div>
                <div class="collapse mb-1" id="searchVisit">
                    <div class="card card-body row row-cols-1">
                        @include('pet.visit.forms.search')
                    </div>
                </div>
                <div class="collapse mb-1" id="newVisit">
                    <div class="card card-body">
                        @include('pet.visit.forms.create')
                    </div>
                </div>
            </div>
            <hr class="w-50 m-auto">
        </div>
    </div>
    <div class="visit_block">
        @include('pet.visit.list')
    </div>
@endsection
