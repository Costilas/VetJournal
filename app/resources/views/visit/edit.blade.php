@extends('layouts.body.app.layout')

@section('title') Редактировать прием:({{$visit->pet->pet_name}}) @endsection

@section('content')
    <div class="card m-3">
        <div class="card-body">
            <h3 class="padding_block text-center m-3">Редактирование приема пациента <strong>{{$visit->pet->pet_name}}</strong> от <strong>{{$visit->visitDate()}}</strong>.</h3>
            <div class="col-lg-10 m-auto">
                <form action="{{route('visit.update', ['id'=>$visit->id])}}" method="POST">
                    @csrf
                    <div class="row row-cols-auto justify-content-center">
                        <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="weight">Вес(кг.):</label>
                            <input class="form-control @error('visit.weight') is-invalid @enderror"
                                   id="weight"
                                   type="text"
                                   name="visit[weight]"
                                   value="{{session()->getOldInput('visit.weight')??$visit->weightFormat()}}">
                        </div>
                        <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="temperature">Температура:</label>
                            <input class="form-control @error('visit.temperature') is-invalid @enderror"
                                   id="temperature"
                                   type="text"
                                   name="visit[temperature]"
                                   value="{{session()->getOldInput('visit.temperature')??$visit->temperatureFormat()}}">
                        </div>
                        <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <div class="col">
                                <label for="pre_diagnosis">Предварительный диагноз:</label>
                                <input class="form-control @error('visit.pre_diagnosis') is-invalid @enderror"
                                       id="pre_diagnosis"
                                       type="text"
                                       name="visit[pre_diagnosis]"
                                       value="{{session()->getOldInput('visit.pre_diagnosis')??$visit->pre_diagnosis}}">
                            </div>
                        </div>
                        <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="doctor">Кем проведен прием:</label>
                            <select class="form-select select-css @error('visit.user_id') is-invalid @enderror"
                                    id="doctor"
                                    name="visit[user_id]">
                                @foreach($doctors as $doctor)
                                    <option value="{{$doctor->id}}"
                                            @if($doctor->id==$visit->user_id) selected @endif>{{$doctor->doctorName()}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="visit_info">Информация о приеме:</label>
                            <textarea class="form-control @error('visit.visit_info') is-invalid @enderror"
                                      id="visit_info"
                                      name="visit[visit_info]"
                                      style=" height: 250px;">{{session()->getOldInput('visit.visit_info')??$visit->visit_info}}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Сохранить изменения
                    </button>
                    <a class="btn btn-info" href="{{route('pet.show', ['pet'=>$visit->pet->id])}}">К пациенту</a>
                </form>
            </div>
        </div>
    </div>
@endsection
