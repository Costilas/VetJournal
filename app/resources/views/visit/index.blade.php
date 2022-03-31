@extends('layouts.layout')


@section('content')
    <form action="{{route('visit.search')}}" method="GET">
        @csrf
        <div class="row mb-3 mt-3">
            <h3>Искать приемы:</h3>
            <div class="col text-center">
                <label for="visit[date_start]">С:</label>
                <input type="date" class="form-control w-50 m-auto"
                       name="visit[date_start]"
                       aria-label="visit[date_start]">
            </div>
            <div class="col text-center">
                <label for="visit[date_end]">По:</label>
                <input type="date" class="form-control w-50 m-auto"
                       name="visit[date_end]"
                       max="{{date('Y-m-d')}}"
                       aria-label="visit[date_end]">
            </div>
        </div>
        <input type="hidden" name="visitSearchByDate">

        <button type="submit" class="btn btn-primary m-auto"><i class="bi bi-plus-lg"></i> Искать</button>
    </form>
    <form action="{{route('visit.search')}}" method="GET">
        @csrf
        <input type="hidden" name="visit[today]">
        <button type="submit" class="btn btn-primary m-3">Сегодня</button>
    </form>
    <form action="{{route('visit.search')}}" method="GET">
        @csrf
        <input type="hidden" name="visit[yesterday]">
        <button type="submit" class="btn btn-primary m-3">Вчера</button>
    </form>
    <form action="{{route('visit.search')}}" method="GET">
        @csrf
        <input type="hidden" name="visit[week]">
        <button type="submit" class="btn btn-primary m-3">Неделя</button>
    </form>

    @if(!empty($visits))
        @foreach($visits as $visit)
            <div> {{$visit->dateFormat()}} {{$visit->pre_diagnosis}} {{$visit->pet->pet_name}} <a href="{{route('pet.show', ['id'=>$visit->pet->id])}}">Просмотр</a></div>
        @endforeach
        {{$visits->links()}}
    @endif
@endsection
