<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <!--<title>GK Quiz Time</title>-->
    <title>GK Quiz Time</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/quiz.css') }}">
    <link href="{{ asset('diploma.ico') }}" rel="icon" type="image/x-icon" />
</head>
<body>
        @yield('content')
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}" charset="UTF-8"></script>
</body>
</html>