@extends('layouts.body.app.layout')

@section('title') Пациент::{{$pet->pet_name}} ({{$owner->last_name}}) @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="text-center m-5">Пациент: <strong>{{$pet->pet_name}}</strong>({{$owner->last_name}})</h2>
        </div>
    </div>
    <div class="info_block row row-cols-auto justify-content-center">
        <div class="col col-lg-6 col-xl-6 col-md-10 col-sm-12 xs-w-9 xs-mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title text-center">Кличка: <strong>{{$pet->pet_name}}</strong></h5>
                    <p class="card-text">Вид: <strong>{{$pet->kind->kind}}</strong></p>
                    <p class="card-text">Пол: <strong>{{$pet->gender->gender}}</strong></p>
                    <p class="card-text">Дата рождения: <strong>{{$pet->birthDate('d-m-Y')}}</strong></p>
                    <p class="card-text">Возраст: <em>{{$pet->countYears()}}</em></p>
                    <p class="card-text">Кастрация: <em>{{$pet->castration->condition}}</em> {!! $pet->castration->icon !!}</p>

                    @include('layouts.components.whatsAppShareButton')

                    <div class="text-center mt-3">
                        <a href="{{route('pet.edit', ['pet'=>$pet])}}" class="btn btn-primary"><i
                                class="bi bi-pencil-fill"></i> Редактировать данные пациента</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-lg-6 col-xl-6 col-md-10 col-sm-12 xs-w-9 xs-mb-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="text-center"> Владелец:
                        <b>{{$owner->last_name}} {{$owner->name}} {{$owner->patronymic}}</b></h5>
                    <p class="card-text"> Адрес: <b>{{$owner->address}}</b></p>
                    <p class="card-text"> Телефон: <b>{{$owner->phone ?? '---'}}</b></p>
                    <p class="card-text"> Доп. телефон: <b>{{$owner->additional_phone ?? '---'}}</b></p>
                    <p class="card-text"> Email: <b>{{$owner->email ?? '---'}}</b></p>
                    <div class="text-center xs-mt-3">
                        <a href="{{route('owners.show', ['id'=>$owner->id])}}" class="btn btn-primary"><i
                                class="bi bi-file-earmark-person"></i> Профиль владельца</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1">
        <div class="col-12">
            <div class="actions">
                <div class="m-3 text-center">
                    <a class="btn btn-success xs-m-1" data-bs-toggle="collapse" href="#newVisit" role="button"
                       aria-expanded="false"
                       aria-controls="newVisit m-1">
                        <i class="bi bi-journal-plus"></i> Новый прием
                    </a>
                    <a class="btn btn-warning xs-m-1" data-bs-toggle="collapse" href="#searchVisit" role="button"
                       aria-expanded="false"
                       aria-controls="searchVisit m-1">
                        <i class="bi bi-search"></i> Поиск приемов по дате
                    </a>
                    @if(Route::currentRouteName() === 'pet.visit.search')
                        <a class="btn btn-secondary xs-m-1" href="{{route('pet.show', ['pet'=>$pet])}}"><i
                                class="bi bi-x-octagon"></i> Сброс фильтров поиска</a>
                    @endif

                </div>
                <div class="collapse mb-1" id="searchVisit">
                    <div class="card card-body row row-cols-1">
                        @include('pet.visit.forms.search')
                    </div>
                </div>
                <div class="collapse mb-1" id="newVisit">
                    <div class="card card-body">
                        @include('pet.visit.forms.add')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="visit_block">
        <p class="text-center">Поиск по фильтрам: <br>
            @if(!empty($filterCondition))
                @foreach($filterCondition as $input => $condition)
                    <em>{{$input}}:</em> <strong>{{$condition}}</strong>
                @endforeach
            @else
               За все время.
            @endif

        </p>
        @include('pet.visit.list')
    </div>
@endsection
