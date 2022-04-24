@extends('layouts.html')

@section('layout')
    <body style="background-size:cover; background-color: #1a202c;">
    <main>
        <div class="container-xxl">
            <div class="min-vh-100 d-flex align-items-center justify-content-center">
                @include('layouts.notify')
                @yield('content')
            </div>
        </div>
    </main>
    <script src="/js/app.js"></script>
    </body>
@endsection
