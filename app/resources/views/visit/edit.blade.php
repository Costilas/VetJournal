@extends('layouts.body.app.layout')

@section('title') Редактировать прием:({{$visit->pet->pet_name}}) @endsection

@section('content')
    <h3 class="border_block padding_block text-center m-3">Редактирование приема от {{$visit->dateFormat()}} животного {{$visit->pet->pet_name}}
        (ID:{{$visit->pet->id}})</h3>
    <div class="col-lg-10 m-auto">
        <form action="{{route('visit.update', ['id'=>$visit->id])}}" method="POST">
            @csrf
            <div class="row row-cols-auto justify-content-center">
                <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="weight">Вес(kg):</label>
                    <input class="form-control @error('visit.weight') is-invalid @enderror"
                           type="text"
                           name="visit[weight]"
                           value="{{session()->getOldInput('visit.weight')??$visit->weightFormat()}}">
                </div>
                <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="temperature">Температура:</label>
                    <input class="form-control @error('visit.temperature') is-invalid @enderror"
                           type="text"
                           name="visit[temperature]"
                           value="{{session()->getOldInput('visit.temperature')??$visit->temperatureFormat()}}">
                </div>
                <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <div class="col">
                        <label for="pre_diagnosis">Предварительный диагноз:</label>
                        <input class="form-control @error('visit.pre_diagnosis') is-invalid @enderror"
                               type="text"
                               name="visit[pre_diagnosis]"
                               value="{{session()->getOldInput('visit.pre_diagnosis')??$visit->pre_diagnosis}}">
                    </div>
                </div>
                <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="visit[doctor_id]">Кем проведен прием:</label>
                    <select class="form-control @error('visit.user_id') is-invalid @enderror"
                            name="visit[user_id]">
                        @foreach($doctors as $doctor)
                            <option value="{{$doctor->id}}" @if($doctor->id==$visit->user_id) selected @endif>{{$doctor->doctorName()}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="visit_info">Информация о приеме:</label>
                    <textarea class="form-control @error('visit.visit_info') is-invalid @enderror"
                              name="visit[visit_info]"
                              style=" height: 250px;">
                        {{session()->getOldInput('visit.visit_info')??$visit->visit_info}}
                        </textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Сохранить изменения</button>
            <a class="btn btn-info" href="{{route('pet.show', ['id'=>$visit->pet->id])}}">Назад к питомцу</a>
        </form>
    </div>
@endsection
