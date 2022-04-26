@extends('layouts.html')

@section('layout')
    <body style="background-size:cover; background-color: #1a202c;">
    <main>
        <div class="container-xxl">
            <div class="min-vh-100 d-flex align-items-center justify-content-center">
                <div class="row row-cols-1 justify-content-center">
                    <div class="col-12">
                        @include('layouts.notify')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="/js/app.js"></script>
    </body>
@endsection
