@extends('layouts.loginBackground')

@section('title') VetJournal::Вход @endsection

@section('content')
    <h2>Вход:</h2>
    <form method="POST" action="{{route('auth')}}">
        @csrf
        <label for="email">Введите e-mail:</label><br>
        <input type="email" name="user[email]" id="email" value="{{session()->getOldInput('user.email')??''}}">
        <br>
        <label for="password">Введите пароль:</label><br>
        <input type="password" name="user[password]" id="password" value="">
        <br>
        <button type="submit"> Войти </button>
    </form>
@endsection
