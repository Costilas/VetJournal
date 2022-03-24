@extends('layouts.layout')


@section('content')
    <p> Всего владельцев: {{$ownerCount}}</p>
    <p> Всего питомцев: {{$petCount}}</p>
    <p> Всего приемов: {{$visitCount}}</p>
    <div class="ways">
        <div class="ways-item visits">
            <a href="{{route('search')}}"><h3>Картотека</h3></a>
        </div>
        <div class="ways-item notes">
            <a href="/notes"><h3>Заметки</h3></a>
        </div>
    </div>
@endsection
