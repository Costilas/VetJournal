@extends('admin.layouts.layout')


@section('content')
    <h2>Сотрудники</h2>

    <div>
        <a href="{{route('admin.user.register')}}">Добавить сотрудника</a>
    </div>
    @if(!empty($users->items()))
        @foreach($users as $user)
            {{$user->id .' '. $user->email .' '. $user->last_name .' '. $user->name .' '. $user->patronymic}}
            <a href="{{route('admin.user.edit', ['id'=>$user->id])}}">Редактировать</a>
            @if($user->is_active)
                <a href="{{route('admin.user.deactivate', ['id'=>$user->id])}}">Деактивировать</a>
            @else
                <a href="{{route('admin.user.restore', ['id'=>$user->id])}}">Активировать</a>
            @endif
            <br>
        @endforeach
    @else
        Сотрудников пока не зарегистрировано.
    @endif
@endsection
