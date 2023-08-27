@extends('layouts.html')

@section('layout')
    <body>
    <div class="wrapper">
        @include('layouts.header')
        <main>
            <div class="container">
                @include('layouts.notify')
                @yield('content')
            </div>
        </main>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    </body>
@endsection
