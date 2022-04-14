@extends('layouts.body.app.layout')

@section('title') Ред.пациента::{{$pet->pet_name}} @endsection

@section('content')
    <h3 class="border_block padding_block text-center m-3">Редактирование пациента {{$pet->pet_name}}
        (ID:{{$pet->id}})</h3>
    <div class="col-lg-10 m-auto">
        <form action="{{route('pet.update', ['id'=>$pet->id])}}" method="POST">
            @csrf
            <div class="row row-cols-auto justify-content-center">
                <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="last_name">Кличка питомца:</label>
                    <input type="text" class="form-control @error('pet.pet_name') is-invalid @enderror"
                           name="pet[pet_name]" placeholder="Боня" aria-label="Pet name"
                           value="{{session()->getOldInput('pet.pet_name')??$pet->pet_name}}">
                </div>
                <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="birth">Дата рождения питомца:</label>
                    <input type="date" class="form-control @error('pet.birth') is-invalid @enderror"
                           name="pet[birth]" aria-label="birth"
                           value="{{session()->getOldInput('pet.birth')??$pet->birth}}">
                </div>
                <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="pet[kind_id]">Вид питомца:</label>
                    <select name="pet[kind_id]" class="form-control text-start @error('pet.kind_id') is-invalid @enderror">
                        @foreach($kinds as $kind)
                            <option class="mb-sm-5" @if($kind->id == $pet->kind_id) selected @endif value="{{$kind->id}}" >{{$kind->kind}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-xl-3 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="pet[gender_id]">Пол питомца:</label>
                    @foreach($genders as $gender)
                        <br><input type="radio" name="pet[gender_id]" @if($gender->id == $pet->gender_id) checked @endif value="{{$gender->id}}"> <i
                            class="bi bi-gender-{{$gender->icon}} @error('pet.gender_id') is-invalid @enderror"></i>  {{$gender->gender}}
                    @endforeach
                </div>

            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Сохранить изменения</button>
            <a class="btn btn-info m-3" href="{{route('pet.show', ['id'=>$pet->id])}}">Назад к питомцу</a>
        </form>
@endsection