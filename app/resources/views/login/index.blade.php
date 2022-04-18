@extends('layouts.body.login.layout')

@section('title') VetJournal::Вход @endsection

@section('content')
    <div class="row">
        <div class="col col-xl-6 col-lg-6 col-md-10 col-sm-12 m-auto">
            <div class="login_form_block m-auto text-center">
                <div class="row row-cols-1 mb-3">
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
                    <div class="row row-cols-1 mb-3">
                        <div class="col col-lg-6 col-md-8 col-sm-9 m-auto xs-w-9 xs-mb-3">
                            <label for="login" class="form-label">Логин:</label>
                            <input type="text" name="user[email]" class="form-control @error('user.email') is-invalid @enderror"
                                   id="login" aria-describedby="emailHelp" value="{{session()->getOldInput('user.email')}}">
                        </div>
                    </div>
                    <div class="row row-cols-1 mb-3">
                        <div class="col col-lg-6 col-md-8 col-sm-9 m-auto xs-w-9 xs-mb-3">
                            <label for="inputPassword" class="form-label">Пароль:</label>
                            <input type="password" name="user[password]" class="form-control @error('user.password') is-invalid @enderror"
                                   id="inputPassword">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-3">Войти</button>
                </form>
            </div>
        </div>
    </div>
@endsection
