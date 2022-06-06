@extends('layouts.body.app.layout')

@section('title') VetJournal::Контроль ошибок @endsection

@section('content')
    <div class="card text-center m-2 p-2">
        <h2>Список возможных ошибок</h2>
        <p>
            В данном разделе отображается список пациентов, у которых нет ни одного приема. <br>
            Появление в данном списке пациентов указывает на то, что прием для них<br>
            <strong>не был создан</strong>.

        </p>
    </div>
    <div class="row m-2">
        <div class="col col-lg-12 m-auto">
            @include('control.list')
        </div>
    </div>
    {{$missedPets->links()}}
@endsection
