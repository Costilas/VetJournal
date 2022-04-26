@extends('layouts.body.login.layout')

@section('title') VetJournal::Вход @endsection

@section('content')
    <div class=" row row-cols-1 login_form_block m-auto text-center">
        <div class="col">
            <div class="row mb-3">
                <div class="col m-auto">
                    <div class="logo m-auto mb-3">
                        <img src="{{asset('img/logo.png')}}" class="logo-img" alt="Logo image with fox">
                    </div>
                    <div class="mb-3">
                        <h2>Добро пожаловать в VetJournal!</h2>
                    </div>
                </div>

            </div>
            <form method="POST" action="{{route('auth')}}">
                @csrf
                <div class="row mb-3">
                    <div class="col col-lg-8 col-md-8 col-sm-10 m-auto xs-w-9 xs-mb-3">
                        <label for="login" class="form-label">Логин:</label>
                        <input type="text"
                               name="email"
                               maxlength="70"
                               class="form-control @error('user.email') is-invalid @enderror"
                               id="login" aria-describedby="email"
                               value="{{session()->getOldInput('email')??old('email')}}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col col-lg-8 col-md-8 col-sm-10 m-auto xs-w-9 xs-mb-3">
                        <label for="inputPassword" class="form-label">Пароль:</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('user.password') is-invalid @enderror"
                               id="inputPassword">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary m-3">Войти</button>
            </form>
        </div>
        </div>
@endsection
