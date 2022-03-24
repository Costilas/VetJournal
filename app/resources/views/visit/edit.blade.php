@extends('layouts.layout')


@section('content')
    <h3 class="text-center m-3">Редактирование приема от {{$visit->visit_date}} животного {{$visit->pet->pet_name}}(ID:{{$visit->pet->id}})</h3>
    <div>
        <form action="{{route('visit.update')}}" method="POST">
            @csrf
            <div class="row mb-3 mt-3">
                <div class="col">
                    <input class="form-control" type="date" name="visit_date" value="{{$visit->visit_date}}">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <input class="form-control" type="number" name="weight" value="{{$visit->weight}}">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <input class="form-control" type="number" name="temperature" value="{{$visit->temperature}}">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <input class="form-control" type="text" name="pre_diagnosis" value="{{$visit->pre_diagnosis}}">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <textarea class="form-control" name="visit_info">{{$visit->pre_diagnosis}}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Сохранить изменения</button>

            <a class="btn btn-info" href="{{route('pet.show', ['id'=>$visit->pet->id])}}">Назад к питомцу</a>

            <input type="hidden" name="pet_id" value="{{$visit->pet->id}}">
            <input type="hidden" name="visit_id" value="{{$visit->id}}">
        </form>
    </div>
@endsection
