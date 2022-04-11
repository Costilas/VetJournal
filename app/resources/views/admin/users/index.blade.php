@extends('admin.layouts.layout')


@section('content')
    <h2>Сотрудники</h2>

    <div>
        <a href="{{route('admin.user.register')}}">Добавить сотрудника</a>
    </div>
    <div>
        <form action="{{route('admin.users')}}" method="GET">
            <input type="hidden" name="search" value="all">
            <button type="submit">Все пользователи</button>
         </form>
        <form action="{{route('admin.users')}}" method="GET">
            <input type="hidden" name="search" value="active">
            <button type="submit">Только активные</button>
        </form>
        <form action="{{route('admin.users')}}" method="GET">
            <input type="hidden" name="search" value="inactive">
            <button type="submit">Только неактивные</button>
        </form>

    </div>
    @if(!empty($users->items()))
        @foreach($users as $user)
            {{$user->id .' '. $user->email .' '. $user->last_name .' '. $user->name .' '. $user->patronymic}}
            <a href="{{route('admin.user.edit', ['id'=>$user->id])}}">Редактировать</a>
            @if($user->id == $currentUserId)
                (Текущий пользователь)
            @else
                @if($user->is_active)
                    <a href="{{route('admin.user.deactivate', ['id'=>$user->id])}}">Деактивировать</a>
                @else
                    <a href="{{route('admin.user.restore', ['id'=>$user->id])}}">Активировать</a>
                @endif
            @endif
            <br>
        @endforeach
    @else
        Сотрудников пока не зарегистрировано.
    @endif
@endsection
