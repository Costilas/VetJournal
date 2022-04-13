@extends('layouts.body.admin.layout')

@section('title') VetJournal::Добавить пользователя @endsection

@section('content')
    <h2>Создать новый профиль сотрудника:</h2>
    <form method="POST" action="{{route('admin.user.store')}}">
        @csrf
        <label for="email">Введите e-mail:</label><br>
        <input type="email" name="user[email]" id="email" value="{{session()->getOldInput('user.email')??''}}">
        <br>
        <label for="name">Введите имя:</label><br>
        <input type="text" name="user[name]" id="name" value="{{session()->getOldInput('user.patronymic')??''}}">
        <br>
        <label for="patronymic">Введите отчество:</label><br>
        <input type="text" name="user[patronymic]" id="patronymic" value="{{session()->getOldInput('user.patronymic')??''}}">
        <br>
        <label for="last_name">Введите фамилию:</label><br>
        <input type="text" name="user[last_name]" id="last_name" value="{{session()->getOldInput('user.last_name')??''}}">
        <br>
        <label for="password">Введите пароль для нового сотрудника:</label><br>
        <input type="password" name="user[password]" id="password" value="">
        <br>
        <label for="password_confirmed">Подтвердите пароль:</label><br>
        <input type="password" name="user[password_confirmation]" id="password_confirmed" value="">
        <br>
        <button type="submit"> Добавить </button>
    </form>
@endsection
