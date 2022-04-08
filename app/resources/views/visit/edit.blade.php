@extends('layouts.layout')

@section('title') Редактировать прием:({{$visit->pet->pet_name}}) @endsection

@section('content')
    <h3 class="text-center m-3">Редактирование приема от {{$visit->dateFormat()}} животного {{$visit->pet->pet_name}}
        (ID:{{$visit->pet->id}})</h3>
    <div>
        <form class="w-50 m-auto" action="{{route('visit.update')}}" method="POST">
            @csrf
            <div class="new_visit_info">
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="weight">Вес(kg):</label>
                        <input class="form-control w-25 m-auto @error('visit.weight') is-invalid @enderror"
                               type="text"
                               name="visit[weight]"
                               value="{{session()->getOldInput('visit.weight')??$visit->weightFormat()}}">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="temperature">Температура:</label>
                        <input class="form-control w-25 m-auto @error('visit.temperature') is-invalid @enderror"
                               type="text"
                               name="visit[temperature]"
                               value="{{session()->getOldInput('visit.temperature')??$visit->temperatureFormat()}}">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="pre_diagnosis">Предварительный диагноз:</label>
                        <input class="form-control m-auto w-50 @error('visit.pre_diagnosis') is-invalid @enderror"
                               type="text"
                               name="visit[pre_diagnosis]"
                               value="{{session()->getOldInput('visit.pre_diagnosis')??$visit->pre_diagnosis}}">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="visit_info">Информация о приеме:</label>
                        <textarea class="form-control @error('visit.visit_info') is-invalid @enderror"
                                  name="visit[visit_info]"
                                  style=" height: 500px;">
                        {{session()->getOldInput('visit.visit_info')??$visit->visit_info}}
                        </textarea>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <label for="visit[doctor_id]">Кем проведен прием:</label>
                        <select class="w-25 m-auto form-control @error('visit.doctor_id') is-invalid @enderror"
                                name="visit[doctor_id]">
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}" @if($doctor->id==$visit->user_id) selected @endif>{{$doctor->doctorName()}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Сохранить изменения</button>
            <input type="hidden" name="visit[visit_id]" value="{{$visit->id}}">

            <a class="btn btn-info" href="{{route('pet.show', ['id'=>$visit->pet->id])}}">Назад к питомцу</a>


        </form>
    </div>
@endsection
