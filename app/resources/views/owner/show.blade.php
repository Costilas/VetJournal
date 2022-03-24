@extends('layouts.layout')

@section('title') Владелец::{{$owner->name}} @endsection

@section('content')

    <div class="">







    </div>
    {{$owner->name}}

    @foreach($owner->pets as $pet)
        {{$pet->pet_name}}
    @endforeach

@endsection
