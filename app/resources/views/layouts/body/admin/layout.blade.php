@extends('layouts.html')

@section('layout')
    <body>
        <div class="wrapper">
            @include('layouts.header')
            <main>
                <div class="d-flex justify-content-center">
                    @include('admin.layouts.menu')
                    <div class="container">
                        @include('layouts.notify')
                        @yield('content')
                    </div>
                </div>
            </main>
            @include('layouts.footer')
        </div>
        <script src="/js/app.js"></script>
    </body>
@endsection
