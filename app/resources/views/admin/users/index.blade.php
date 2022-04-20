@extends('layouts.body.app.layout')

@section('title') VetJournal::Сотрудники @endsection

@section('content')
    <div class="row row-cols-1">
        <div class="col-10 m-auto">
            <div class="card mb-3 mt-3 p-3">
                <div class="owner_credentials">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <h2>Сотрудники</h2>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-success" href="{{route('admin.user.register')}}">
                                <i class="bi bi-person-plus-fill"></i> Новый сотрудник
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1">
        <div class="col-auto m-auto">
            <div class="card mb-3 p-2">
                <div class="text-center">
                    <a href="{{route('admin.users', ['search'=>'all'])}}" class="btn btn-outline-info m-1">
                        <i class="bi bi-list-nested"></i> Все пользователи
                    </a>
                    <a href="{{route('admin.users', ['search'=>'active'])}}" class="btn btn-outline-success m-1">
                        <i class="bi bi-capslock-fill"></i> Только активные
                    </a>
                    <a href="{{route('admin.users', ['search'=>'inactive'])}}" class="btn btn-outline-danger m-1">
                        <i class="bi bi-lock-fill"></i> Только неактивные
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-12 m-auto">
            {{view('admin.users.list', compact('users'))}}
        </div>
    </div>
@endsection
