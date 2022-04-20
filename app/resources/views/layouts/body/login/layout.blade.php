@extends('layouts.html')

@section('layout')
    <body style="background-size:cover; background-color: #1a202c;">
    <div class="wrapper_login">
        <main>
            <div class="container-xxl">
                @include('layouts.notify')
                @yield('content')
            </div>
        </main>
    </div>
    <script src="/js/app.js"></script>
    </body>
@endsection
