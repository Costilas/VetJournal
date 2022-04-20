@extends('layouts.body.app.layout')

@section('title') VetJournal::Поиск приемов @endsection

@section('content')
    <div class="padding_block bg-white border border_block">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Поиск приемов по дате:</h2>
            </div>
        </div>
        <div class="row row-cols-auto justify-content-center align-items-center">
            <div
                class="col col-xl-3 col-lg-3 col-md-3 col-sm-10 m-lg-3 m-md-4 m-sm-3 xs-w-9 xs-mb-3 xs-mt-3 text-center align-middle">
                <a href="{{route('visits')}}" class="btn btn-primary">Сегодня</a>
            </div>
            <form
                class="col col-xl-3 col-lg-3 col-md-3 col-sm-10 m-lg-3 m-md-4 m-sm-3 xs-w-9 xs-mb-3 text-center align-middle"
                action="{{route('visits')}}" method="GET">
                @csrf
                <input type="hidden" name="search[from]" value="@createDate(yesterday)">
                <input type="hidden" name="search[to]" value="@createDate(yesterday)">

                <button class="btn btn-primary" type="submit">Вчера</button>
            </form>
            <form
                class="col col-xl-3 col-lg-3 col-md-3 col-sm-10 m-lg-3 m-md-4 m-sm-3 xs-w-9 xs-mb-3 text-center align-middle"
                action="{{route('visits')}}" method="GET">
                @csrf
                <input type="hidden" name="search[from]" value="@createDate(-1 week)">
                <input type="hidden" name="search[to]" value="@createDate(today)">
                <button type="submit" class="btn btn-primary">Неделя</button>
            </form>
        </div>
        <div class="row">
            <div class="col col-lg-10 m-auto">
                <form class="search_form text-center m-auto" action="{{route('visits')}}" method="GET">
                    @csrf
                    <div class="row row-cols-auto justify-content-center">
                        <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="search[from]">С:</label>
                            <input type="date" id="from" class="form-control @error('search.from') is-invalid @enderror"
                                   name="search[from]"
                                   max="@createDate(today)"
                                   aria-label="visits[from]"
                                   value="{{$validatedRequest['search']['from']??''}}">
                        </div>
                        <div class="col col-xl-6 col-lg-6 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3">
                            <label for="visits[to]">По:</label>
                            <input type="date" id="to" class="form-control @error('search.to') is-invalid @enderror"
                                   name="search[to]"
                                   max="@createDate(today)"
                                   aria-label="visits[to]"
                                   value="{{$validatedRequest['search']['to']??''}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-search"></i> Поиск</button>
                </form>
            </div>
        </div>

        {{view('layouts.filter.filterCondition', compact('validatedRequest'))}}
        {{view('visit.list', compact('visits'))}}
        {{$visits->links()}}
    </div>
@endsection
