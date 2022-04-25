@extends('layouts.body.app.layout')

@section('title') Ред.пациента::{{$pet->pet_name}} @endsection

@section('content')
    <div class="card m-3">
        <div class="card-body">
            <h3 class="padding_block text-center m-3">Редактирование пациента - <strong>{{$pet->pet_name}}</strong></h3>
            <div class="col-lg-10 m-auto">
                <form class="text-center" action="{{route('pet.update', ['pet'=>$pet])}}" method="POST">
                    @csrf
                    <div class="row row-cols-auto justify-content-center">
                        <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="last_name">Кличка питомца:</label>
                            <input type="text" class="form-control @error('pet.pet_name') is-invalid @enderror"
                                   required
                                   maxlength="30"
                                   name="pet[pet_name]" placeholder="Боня" aria-label="Pet name"
                                   value="{{session()->getOldInput('pet.pet_name')??$pet->pet_name}}">
                        </div>
                        <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="birth">Дата рождения питомца:</label>
                            <input type="date" class="form-control @error('pet.birth') is-invalid @enderror"
                                   name="pet[birth]" aria-label="birth"
                                   max="{{$dateInputMaxValue}}"
                                   value="{{session()->getOldInput('pet.birth')??$pet->birthDate('Y-m-d')}}">
                        </div>
                        <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="pet[kind_id]">Вид питомца:</label>
                            <select name="pet[kind_id]"
                                    class="form-control text-start @error('pet.kind_id') is-invalid @enderror">
                                @foreach($kinds as $kind)
                                    <option class="mb-sm-5" @if($kind->id == $pet->kind_id) selected
                                            @endif value="{{$kind->id}}">{{$kind->kind}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="pet[gender_id]">Пол питомца:</label>
                            @foreach($genders as $gender)
                                <br><input type="radio" name="pet[gender_id]"
                                           @if($gender->id == $pet->gender_id) checked @endif value="{{$gender->id}}">
                                <i
                                    class="bi bi-gender-{{$gender->icon}} @error('pet.gender_id') is-invalid @enderror"></i>  {{$gender->gender}}
                            @endforeach
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary xs-m-3"><i class="bi bi-plus-lg"></i> Сохранить
                        изменения
                    </button>
                    <div class="m-3">
                        <a class="btn btn-info xs-m-3" href="{{route('pet.show', ['pet'=>$pet])}}">К питомцу</a>
                        <a class="btn btn-warning xs-m-3" href="{{route('owner.show', ['id'=>$pet->owner_id])}}">К
                            владельцу</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
