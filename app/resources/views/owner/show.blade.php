@extends('layouts.layout')


@section('content')

    <div class="">







    </div>
    {{$owner->name}}

    @foreach($owner->pets as $pet)
        {{$pet->pet_name}}
    @endforeach

@endsection
