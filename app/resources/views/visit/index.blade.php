@extends('layouts.layout')

@section('title') VetJournal::Поиск приемов @endsection

@section('content')
    <form action="{{route('visits')}}" method="GET">
        @csrf
        <div class="row mb-3 mt-3">
            <h3>Искать приемы:</h3>
            <div class="col text-center">
                <label for="visits[from]">С:</label>
                <input type="date" class="form-control w-50 m-auto"
                       name="visits[from]"
                       aria-label="visits[from]">
            </div>
            <div class="col text-center">
                <label for="visits[to]">По:</label>
                <input type="date" class="form-control w-50 m-auto"
                       name="visits[to]"
                       max="{{date('Y-m-d')}}"
                       aria-label="visits[to]">
            </div>
        </div>

        <button type="submit" class="btn btn-primary m-auto"><i class="bi bi-plus-lg"></i> Искать</button>
    </form>
    <form action="{{route('visits')}}" method="GET">
        @csrf
        <input type="hidden" name="search" value="today">
        <button type="submit" class="btn btn-primary m-3">Сегодня</button>
    </form>
    <form action="{{route('visits')}}" method="GET">
        @csrf
        <input type="hidden" name="search" value="yesterday">
        <button type="submit" class="btn btn-primary m-3">Вчера</button>
    </form>
    <form action="{{route('visits')}}" method="GET">
        @csrf
        <input type="hidden" name="search" value="week">
        <button type="submit" class="btn btn-primary m-3">Неделя</button>
    </form>

    @if(!empty($visits))
        @foreach($visits as $visit)
            <div> {{$visit->dateFormat()}} {{$visit->pre_diagnosis}} {{$visit->pet->pet_name}} <a
                    href="{{route('pet.show', ['id'=>$visit->pet->id])}}">К питомцу </a> <a
                    href="{{route('visit.edit', ['id'=>$visit->id])}}">Редактировать</a></div>
        @endforeach
        {{$visits->links()}}
    @endif
@endsection
