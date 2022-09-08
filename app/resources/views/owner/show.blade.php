@extends('layouts.body.app.layout')

@section('title') Владелец::{{$owner->last_name}} @endsection

@section('content')
    <div class="row row-cols-1">
        <div class="col-8 card mb-3 mt-3 p-3 m-auto text-center">
            <h2><b>{{$owner->last_name}} {{$owner->name}} {{$owner->patronymic}}</b></h2>
                <p>Телефон: <b>{{$owner->phone ?? '---'}}</b></p>
            <p>Доп. телефон: <b>{{$owner->additional_phone ?? '---'}}</b></p>
            <p>Дата регистрации: <b>{{$owner->registerDate()}}</b></p>
            <p>Адрес: <b>{{$owner->address}}</b></p>
            <p>Email: <b>{{$owner->email ?? '---'}}</b></p>
            @include('layouts.components.whatsAppShareButton')
        </div>
    </div>
    <div class="row row-cols-1">
        <div class="col-auto m-auto text-center">
            <div class="card mb-3 p-2">
                <a class="btn btn-success m-1" data-bs-toggle="collapse" href="#newPet" role="button"
                   aria-expanded="false"
                   aria-controls="newPet">
                    <i class="bi bi-journal-plus"></i> Добавить питомца
                </a>
                <a class="btn btn-warning m-1" data-bs-toggle="collapse" href="#editOwner" role="button"
                   aria-expanded="false"
                   aria-controls="editOwner">
                    <i class="bi bi-pencil-square"></i> Редактировать профиль владельца
                </a>
            </div>
        </div>
    </div>
    <div class="row row-cols-1">
        <div class="col-xl-8 col-lg-9 col-md-10 xs-w-9 collapse m-auto" id="newPet">
            <div class="card card-body m-2">
                @include('owner.pet.forms.add')
            </div>
        </div>
        <div class="col-xl-8 col-lg-9 col-md-10 xs-w-9 collapse m-auto" id="editOwner">
            <div class="card card-body m-2">
                @include('owner.forms.edit')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-8 m-auto">
            @include('owner.pet.list')
        </div>
    </div>
@endsection
