@extends('layouts.layout')

@section('title') VetJournal::Поиск карт @endsection

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
        <form class="search_form w-50 m-auto text-center" method="GET" action="{{route('cards')}}">
            @csrf
            <div class="row mb-3 mt-3">
                <div class="col">
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                           name="last_name" placeholder="Фамилия" aria-label="Last name"
                           value="{{ request()->input('last_name')}}">

                </div>
                <div class="col">
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" placeholder="Имя" aria-label="First name"
                           value="{{ request()->input('name') }}">
                </div>
                <div class="col">
                    <input type="text" class="form-control @error('patronymic') is-invalid @enderror"
                           name="patronymic" placeholder="Отчество" aria-label="Patronymic"
                           value="{{ request()->input('patronymic') }}">
                </div>
                <div class="col">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                           name="phone" placeholder="Телефон" aria-label="Phone"
                           value="{{ request()->input('phone') }}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control @error('pets') is-invalid @enderror"
                           name="pets" placeholder="Кличка питомца" aria-label="pets"
                           value="{{request()->input('pets')}}">
                </div>
            </div>

            <button type="submit" name="search" class="btn btn-primary m-3"><i class="bi bi-search"></i> Поиск</button>

        </form>
        @if(!empty($owners))
            {{view('card.list', compact('owners'))}}
        @endif
    </div>
@endsection
