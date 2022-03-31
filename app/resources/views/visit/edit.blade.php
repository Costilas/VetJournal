@extends('layouts.layout')


@section('content')
    <h3 class="text-center m-3">Редактирование приема от {{$visit->visit_date}} животного {{$visit->pet->pet_name}}(ID:{{$visit->pet->id}})</h3>
    @include('layouts.notify')
    <div>
        <form class="w-50 m-auto" action="{{route('visit.update')}}" method="POST">
            @csrf
            <div class="row mb-3 mt-3">
                <div class="col text-center">
                    <p>Время/Дата приема: {{$visit->dateFormat()}}</p>
                </div>
            </div>
            <div class="new_visit_info">
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="weight">Вес(kg):</label>
                        <input class="form-control w-25 m-auto"
                               type="number"
                               name="visit[weight]"
                               value="{{$visit->weight}}">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="temperature">Температура:</label>
                        <input class="form-control w-25 m-auto"
                               type="number"
                               name="visit[temperature]"
                               value="{{$visit->temperature}}">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="pre_diagnosis">Предварительный диагноз:</label>
                        <input class="form-control m-auto w-50"
                               type="text"
                               name="visit[pre_diagnosis]"
                               value="{{$visit->pre_diagnosis}}">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="visit_info">Информация о приеме:</label>
                        <textarea class="form-control"
                                  name="visit[visit_info]"
                                  style=" height: 500px;">
                    {{$visit->visit_info}}
                </textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Сохранить изменения</button>
            <input type="hidden" name="visit[visit_id]" value="{{$visit->id}}">

            <a class="btn btn-info" href="{{route('pet.show', ['id'=>$visit->pet->id])}}">Назад к питомцу</a>


        </form>
    </div>
@endsection
