@extends('layouts.body.app.layout')

@section('title') Владелец::{{$owner->last_name}} @endsection

@section('content')
    <div class="row row-cols-1">
        <div class="col-12">
            <div class="card mb-3 mt-3 p-3">
                <div class="owner_credentials">
                    <div class="row">
                        <div class="col-12 text-center display-6">
                            <strong>{{$owner->last_name}} {{$owner->name}} {{$owner->patronymic}}</strong>
                        </div>
                        <div class="col-12 text-center m-3">
                            Телефон: <strong>{{$owner->phone}}</strong>
                        </div>
                        <div class="col-12 text-center m-3">
                            Дата регистрации: {{$owner->created_at}}
                        </div>
                        <div class="col-12 text-center m-3">
                            Адрес: {{$owner->address}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1">
        <div class="col-auto m-auto">
            <div class="card mb-3 p-2">
                <div class="text-center">
                    <a class="btn btn-success m-1" data-bs-toggle="collapse" href="#newPet" role="button" aria-expanded="false"
                       aria-controls="newPet">
                        <i class="bi bi-journal-plus"></i> Добавить питомца
                    </a>
                    <a class="btn btn-warning m-1" data-bs-toggle="collapse" href="#editOwner" role="button" aria-expanded="false"
                       aria-controls="editOwner">
                        <i class="bi bi-pencil-square"></i> Редактировать профиль владельца
                    </a>
                </div>
            </div>
        </div>
        <div class="collapse" id="newPet">
            <div class="card card-body m-2">
                @include('owner.pet.add')
            </div>
        </div>
        <div class="collapse" id="editOwner">
            <div class="card card-body m-2">
                hello
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-12 m-auto">
            @include('owner.pet.list')
        </div>
    </div>
@endsection
