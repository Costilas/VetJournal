@extends('layouts.layout')

@section('title') Владелец::{{$owner->name}} @endsection

@section('content')
    <div class="owner_info">
        <div class="owner_credentials">
            {{$owner->name}}
        </div>
        <div class="owner_pet_list">
            @foreach($owner->pets as $pet)
                {{$pet->pet_name}}
                {{$pet->kind->kind}}
                {{$pet->gender->gender}}
            @endforeach
        </div>
    </div>
@endsection
