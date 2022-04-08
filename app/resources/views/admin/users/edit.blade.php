@extends('admin.layouts.layout')


@section('content')

    <h2>Редактировать профиль сотрудника:</h2>
    <form method="POST" action="{{route('admin.user.update')}}">
        @csrf
        <label for="name">Введите отчество:</label><br>
        <input type="text" name="user[name]" id="name" value="{{session()->getOldInput('user.patronymic')??$user->name}}">
        <br>
        <label for="patronymic">Введите отчество:</label><br>
        <input type="text" name="user[patronymic]" id="patronymic" value="{{session()->getOldInput('user.patronymic')??$user->patronymic}}">
        <br>
        <label for="last_name">Введите фамилию:</label><br>
        <input type="text" name="user[last_name]" id="last_name" value="{{session()->getOldInput('user.last_name')??$user->last_name}}">
        <br>

        <button type="submit"> Редактировать </button>
    </form>

    <h3>Изменить данные для входа:</h3>
    <h5>Логин:</h5>
    <form method="POST" action="{{route('admin.user.password', ['id'=>$user->id])}}">
        @csrf
        <label for="email">Введите новую почту сотрудника:</label><br>
        <input type="email" name="user[email]" id="email" value="">
        <br>
        <button type="submit"> Добавить </button>
    </form>
    <h5>Пароль:</h5>
    <form method="POST" action="{{route('admin.user.password', ['id'=>$user->id])}}">
        @csrf
        <label for="password">Введите пароль для нового сотрудника:</label><br>
        <input type="password" name="user[password]" id="password" value="">
        <br>
        <label for="password_confirmed">Подтвердите пароль:</label><br>
        <input type="password" name="user[password_confirmation]" id="password_confirmed" value="">
        <br>
        <button type="submit"> Добавить </button>
    </form>
@endsection
