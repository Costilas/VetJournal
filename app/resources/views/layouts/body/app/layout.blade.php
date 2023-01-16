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
    <script src="https://cdn.tiny.cloud/1/aipi6zup27rwferf0zvlq9lmyd9wxxk6wu4zkl7jzc4xtgkv/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    </body>
@endsection
