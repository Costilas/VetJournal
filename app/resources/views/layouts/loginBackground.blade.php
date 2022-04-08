<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/ico">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>PetVetZooMed</title>
</head>
<body>
<div class="wrapper">
    <main>
        <div class="container">
            @include('layouts.notify')
            @yield('content')
        </div>
    </main>
</div>
<script src="/js/app.js"></script>
</body>
</html>
