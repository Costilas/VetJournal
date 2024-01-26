<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:site_name" content="VetJournal">
    <meta property="og:title" content="Ветеринария в удовольствие." />
    <meta property="og:description" content="Ссылка на данные" />
    <meta property="og:image" itemprop="image" content="{{asset('img/logo.png')}}">
    <meta property="og:url" content="{{config('global.app_url')}}">
    <meta property="og:type" content="website" />

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/ico">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://kit.fontawesome.com/8b6867068a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
</head>
@yield('layout')
</html>
