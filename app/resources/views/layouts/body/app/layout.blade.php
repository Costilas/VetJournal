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
    <script src="/js/app.js"></script>
    </body>
@endsection
