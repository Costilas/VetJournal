@extends('layouts.layout')


@section('content')
    <div class="new_card_block">
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
           aria-controls="collapseExample">
            <i class="bi bi-file-earmark-plus"></i> Создать новую карту
        </a>
        <div class="collapse" id="collapseExample">
            @include('card.create')
        </div>
    </div>

    <div class="search_block">
        <h2 class="text-center">Поиск по существующим:</h2>
        <form class="search_form w-50 m-auto text-center" method="GET" action="{{ route('search') }}">
            @csrf
            <div class="row mb-3 mt-3">
                <div class="col">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                           name="last_name" placeholder="Фамилия" aria-label="Last name"
                           value="{{ old('last_name') }}">
                </div>
                <div class="col">
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" placeholder="Имя" aria-label="First name"
                           value="{{ old('name') }}">
                </div>
                <div class="col">
                    <input type="text" class="form-control @error('patronymic') is-invalid @enderror"
                           name="patronymic" placeholder="Отчество" aria-label="Patronymic"
                           value="{{ old('patronymic') }}">
                </div>
                <div class="col">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                           name="phone" placeholder="Телефон" aria-label="Phone"
                           value="{{ old('phone') }}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control @error('pet_name') is-invalid @enderror"
                           name="pet_name" placeholder="Кличка питомца" aria-label="First name"
                           value="{{old('pet_name')}}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary m-3"><i class="bi bi-search"></i> Поиск</button>

            <input type="hidden" name="search">
        </form>
        @if(!empty($owners))
            {{view('search.list', compact('owners'))}}
        @endif
    </div>


@endsection
