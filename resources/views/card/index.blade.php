@extends('layouts.body.app.layout')

@section('title') VetJournal::Поиск карт @endsection

@section('content')
    <div class="padding_block text-center">
        <a class="btn btn-success" data-bs-toggle="collapse" href="#collapse" role="button" aria-expanded="false"
           aria-controls="collapseExample">
            <i class="bi bi-file-earmark-plus"></i> Создать новую карту
        </a>
        <div class="collapse" id="collapse">
            @include('card.forms.create')
        </div>
    </div>
    <div class="padding_block bg-white border border_block border_block row row-cols-1">
        <div class="col mb-3">
            <h2 class="text-center">Поиск по существующим:</h2>
        </div>
        <div class="col col-lg-10 m-auto">
            <form class="text-center m-auto" method="GET" action="{{route('card.search')}}">
                @csrf
                <div class="row row-cols-auto justify-content-center">
                    <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                               name="lastName" placeholder="Фамилия" aria-label="lastName"
                               value="{{request()->input('lastName')}}">
                    </div>
                    <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" placeholder="Имя" aria-label="First name"
                               value="{{request()->input('name') }}">
                    </div>
                    <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        <input type="text" class="form-control @error('patronymic') is-invalid @enderror"
                               name="patronymic" placeholder="Отчество" aria-label="Patronymic"
                               value="{{request()->input('patronymic') }}">
                    </div>
                    <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                               name="phone" placeholder="Телефон" aria-label="Phone"
                               value="{{request()->input('phone') }}">
                    </div>
                    <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        <input type="text" class="form-control @error('additionalPhone') is-invalid @enderror"
                               name="additionalPhone" placeholder="Дополнительный телефон" aria-label="additionalPhone"
                               value="{{request()->input('additionalPhone') }}">
                    </div>
                    <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                               name="email" placeholder="Электронная почта" aria-label="email"
                               value="{{request()->input('email') }}">
                    </div>
                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        <input type="text" class="form-control @error('pets') is-invalid @enderror"
                               name="pets" placeholder="Кличка питомца" aria-label="pets"
                               value="{{request()->input('pets')}}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary m-3"><i class="bi bi-search"></i> Поиск</button>
                @if(Route::currentRouteName() === 'card.search')
                    <a class="btn btn-secondary xs-m-1" href="{{route('cards')}}"><i class="bi bi-x-octagon"></i> Сброс фильтров поиска</a>
                @endif
            </form>
        </div>

        @if(!empty($owners))
            <p class="text-center">Поиск по фильтрам: <br>
                @foreach($filterCondition as $input => $condition)
                    <em>{{$input}}:</em> <strong>{{$condition}}</strong>
                @endforeach
            </p>
            {{view('card.list', compact('owners'))}}
        @endif
    </div>
@endsection
