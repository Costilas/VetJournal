@extends('layouts.body.app.layout')

@section('title') VetJournal::Добавить пользователя @endsection

@section('content')
    <div class="row m-3">
        <div class="col text-center">
            <a href="{{route('admin.users')}}" class="btn btn-primary">К списку сотрудников</a>
        </div>
    </div>
    <div class="card card-body w-75 mx-auto my-3">
        <form class="text-center" action="{{route('admin.user.store')}}" method="POST">
            @csrf
            <div class="row row-cols-1">
                <div class="col-12">
                    <h4 class="text-center"><i class="bi bi-person-plus"></i> Создать новый профиль сотрудника:</h4>
                </div>
            </div>
            <div class="row row-cols-auto mb-3 mt-3 justify-content-center text-center">
                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="email">E-mail нового сотрудника:</label><br>
                    <input class="form-control @error('user.email') is-invalid @enderror"
                           type="email"
                           name="user[email]"
                           maxlength="50"
                           required
                           id="email"
                           value="{{session()->getOldInput('user.email')??''}}">
                </div>
                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="last_name">Фамилия:</label><br>
                    <input class="form-control @error('user.last_name') is-invalid @enderror"
                           type="text"
                           name="user[last_name]"
                           maxlength="30"
                           required
                           id="last_name"
                           value="{{session()->getOldInput('user.last_name')??''}}">
                </div>

                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="name">Имя:</label><br>
                    <input class="form-control @error('user.name') is-invalid @enderror"
                           type="text"
                           name="user[name]"
                           maxlength="30"
                           required
                           id="name"
                           value="{{session()->getOldInput('user.patronymic')??''}}">
                </div>
                <div class="col col-xl-8 col-lg-8 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="patronymic">Отчество:</label><br>
                    <input class="form-control @error('user.patronymic') is-invalid @enderror"
                           type="text"
                           name="user[patronymic]"
                           maxlength="30"
                           required
                           id="patronymic"
                           value="{{session()->getOldInput('user.patronymic')??''}}">
                </div>

                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="password">Введите пароль:</label><br>
                    <input class="form-control @error('user.password') is-invalid @enderror"
                           type="password"
                           name="user[password]"
                           required
                           id="password">
                </div>
                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="password_confirmed">Подтвердите пароль:</label><br>
                    <input class="form-control @error('user.password_confirmation') is-invalid @enderror"
                           type="password" name="user[password_confirmation]"
                           required
                           id="password_confirmed">
                </div>
                @if($currentUser->is_dev)
                    <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        <input class="@error('user.password_confirmation') is-invalid @enderror"
                               type="checkbox" name="user[is_admin]" value="1"
                               id="user_admin"> Администраторские права.
                    </div>
                @endif
            </div>

            <button class="btn btn-primary" type="submit"> Добавить</button>
        </form>
@endsection
