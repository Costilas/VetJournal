@extends('layouts.body.app.layout')

@section('title') VetJournal::Редактировать пользователя @endsection

@section('content')
    <div class="row m-3">
        <div class="col text-center">
            <a href="{{route('admin.users')}}" class="btn btn-primary">К списку сотрудников</a>
        </div>
    </div>
    <div class="card card-body w-75 mx-auto my-3">
        <form class="text-center m-3 border p-2" action="{{route('admin.user.update',['id'=>$user->id])}}" method="POST">
            @csrf
            <div class="row row-cols-1">
                <div class="col-12">
                    <h4 class="text-center"><i class="bi bi-person-plus"></i> Изменить данные сотрудника:</h4>
                </div>
            </div>
            <div class="row row-cols-auto mb-3 mt-3 justify-content-center text-center">
                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="last_name">Фамилия:</label><br>
                    <input class="form-control @error('user.last_name') is-invalid @enderror"
                           type="text"
                           name="user[last_name]"
                           id="last_name"
                           value="{{session()->getOldInput('user.last_name')??$user->last_name}}">
                </div>

                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="name">Имя:</label><br>
                    <input class="form-control @error('user.name') is-invalid @enderror"
                           type="text"
                           name="user[name]"
                           id="name"
                           value="{{session()->getOldInput('user.name')??$user->name}}">
                </div>
                <div class="col col-xl-8 col-lg-8 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="patronymic">Отчество:</label><br>
                    <input class="form-control @error('user.patronymic') is-invalid @enderror"
                           type="text"
                           name="user[patronymic]"
                           id="patronymic"
                           value="{{session()->getOldInput('user.patronymic')??$user->patronymic}}">
                </div>
            </div>

            <button class="btn btn-primary" type="submit"> Сохранить</button>
        </form>
        @if($currentUser->is_dev)
            <div class="text-center m-3 border p-2">
                <div class="row row-cols-1">
                    <div class="col-12">
                        <h4 class="text-center"><i class="bi bi-boxes"></i> Изменить права:</h4>
                    </div>
                </div>
                <div class="row row-cols-1">
                    <div class="col-12">
                        <h6 class="text-center"> Текущие права:</h6>
                        <p class="fw-bold">
                            @if($user->is_admin)
                                Администратор
                            @else
                                Пользователь
                            @endif
                        </p>

                    </div>
                </div>
                <div class="row row-cols-auto mb-3 mt-3 justify-content-center text-center">
                    <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                        @if($user->is_admin)
                            <a href="{{route('admin.user.demote', ['id'=>$user->id])}}" class="btn btn-primary"> Снять права администратора</a>
                        @else
                            <a href="{{route('admin.user.promote', ['id'=>$user->id])}}" class="btn btn-primary"> Предоставить права администратора</a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <form class="text-center m-3 border p-2" action="{{route('admin.user.login', ['id'=>$user->id])}}" method="POST">
            @csrf
            <div class="row row-cols-1">
                <div class="col-12">
                    <h4 class="text-center"><i class="bi bi-envelope"></i> Изменить почту сотрудника:</h4>
                </div>
            </div>
            <div class="row row-cols-auto mb-3 mt-3 justify-content-center text-center">
                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="email">Новый e-mail:</label><br>
                    <input class="form-control @error('user.email') is-invalid @enderror"
                           type="email"
                           name="user[email]"
                           id="email"
                           value="{{session()->getOldInput('user.email')??''}}">
                </div>
            </div>

            <button class="btn btn-primary" type="submit"> Изменить email</button>
        </form>
        <form class="text-center m-3 border p-2" action="{{route('admin.user.password', ['id'=>$user->id])}}" method="POST">
            @csrf
            <div class="row row-cols-1">
                <div class="col-12">
                    <h4 class="text-center"><i class="bi bi-shield-lock-fill"></i> Изменить пароль:</h4>
                </div>
            </div>
            <div class="row row-cols-auto mb-3 mt-3 justify-content-center text-center">
                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="password">Введите пароль:</label><br>
                    <input class="form-control @error('user.password') is-invalid @enderror"
                           type="password"
                           name="user[password]"
                           id="password">
                </div>
                <div class="col col-xl-8 col-lg-8 col-md-8 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                    <label for="password_confirmed">Подтвердите пароль:</label><br>
                    <input class="form-control @error('user.password_confirmation') is-invalid @enderror"
                           type="password" name="user[password_confirmation]"
                           id="password_confirmed">
                </div>
            </div>

            <button class="btn btn-primary" type="submit"> Изменить пароль</button>
        </form>
    </div>
@endsection
