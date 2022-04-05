@extends('layouts.layout')

@section('title') VetJournal::Главная @endsection

@section('content')
    <p> Всего владельцев: {{$ownerCount}}</p>
    <p> Всего питомцев: {{$petCount}}</p>
    <p> Всего приемов: {{$visitCount}}</p>
    <div class="ways">
        <div class="ways-item visits">
            <a href="{{route('cards')}}"><h3>Картотека</h3></a>
        </div>
        <div class="ways-item visits">
            <a href="{{route('visits')}}"><h3>Приемы</h3></a>
        </div>
        <div class="ways-item notes">
            <a href="{{route('notes')}}"><h3>Заметки</h3></a>
        </div>
    </div>
@endsection
