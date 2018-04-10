<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <!--<title>GK Quiz Time</title>-->
    <title>GK Quiz Time</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" />

    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/quiz.css') }}">
    <link rel="shortcut icon" href="{{ asset('diploma.svg') }}" type="image/x-icon" />
    <style>
    body {
      font-family: "Helvetica Neue", Helvetica, Arial;
      font-size: 14px;
      line-height: 20px;
      font-weight: 400;
      -webkit-font-smoothing: antialiased;
      font-smoothing: antialiased;
      /* color: #3b3b3b;
      background: #cac8c8;
      /* background: #2b2b2b; */
    }
    table {
      margin: 0 0 40px 0;
      width: 100%;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
      display: table;
      text-align:center;
    }
    .btn {
      margin: 10px 30px 10px 0;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }
    li {
      float: left;
    }

    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    li a:hover:not(.active) {
      background-color: #111;
    }

    .active {
      background-color: #189BFC; /*4CAF50 */
    }

    h1.jumbotron {
      text-align:center;
      padding-left:60px;
      padding-right:60px;
      padding-top:27px;
      padding-bottom:27px;
      border-radius:6px;
    }

    .container {
        padding-right:5px;
        padding-left:5px;
        padding-top:3px;
    }
    
    .heading {
      text-align: center;
      background: #27ae60;
      color: #ffffff;
      padding: 21px 27px;
      font-weight: bold;
      font-size: 45px;
    }

    .wrapper {
      margin: 9 auto;
      height:543px;
      padding: 6px 10px;
      max-width: 1350px;
      align-content: center;
      overflow: hidden;
      overflow-x: auto;
      overflow-y: auto;
    }   
    .table {
      margin: 0 0 10px 0;
      width: 100%;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
      display: table;
    }
    @media screen and (max-width: 580px) {
      .table {
        display: block;
      }
    }   
    th {
      font-family: arial, courier, monospace;
      padding: 3px 9px;
      font-size:1.2em;
      border:1px solid #9DD7D7;
      background: #2980b9;
      font-weight: 900;
      text-align: center;
      color: #ffffff;
    }
    .row {
      display: table-row;
      background: #f6f6f6;
    }
    .row:nth-of-type(odd) {
      background: #e9e9e9;
    }
    .row.header {
      font-weight: 900;
      color: #ffffff;
      background: #ea6153;
    }
    .row.green {
      background: #27ae60;
    }
    .row.blue {
      background: #2980b9;
    }
    @media screen and (max-width: 580px) {
    .row {
        padding: 8px 0;
        display: block;
      }
    }
    td, .cell {
      font-family: cursive;
      padding: 3px 12px;
      font-size:18px;
      white-space:wrap;
      border:1px solid #9DD7D7;
      text-align:center;
      padding: 6px 12px;
      display: table-cell;
    }
    @media screen and (max-width: 580px) {
      td, .cell {
        padding: 2px 12px;
        display: block;
      }
    }
    </style>
</head>
<body>
  <div>
    <ul>
      <li><a href="{{ route('record-search') }}" class="active" href="">Record Search</a></li>
      <li><a href="{{ route('manage-questions') }}">Manage Questions</a></li>
      <li><a href="{{ route('get-students') }}">Manage Students</a></li>
      <li style="float:right;"><a href="#">About</a></li>
    </ul>
  </div>
  <div class="container">
  <h1 class="jumbotron">@yield('jumbotronhead')</h1>
        @yield('content')
  </div>
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" charset="UTF-8"></script>
  <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>
  <script type="text/javascript" src="{{ asset('js/locales/bootstrap-datetimepicker.uk.js') }}" charset="UTF-8"></script>

  <script type="text/javascript" src="{{ asset('js/daterangepicker.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/datepickerFunc.js') }}" charset="UTF-8"></script>
  <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}" charset="UTF-8"></script>
  <script type="text/javascript" src="{{ asset('js/script.js') }}" charset="UTF-8"></script>
  @if (notify()->ready())
    <script>
        swal({
            title: "{!! notify()->message() !!}",
            text: "{!! notify()->option('text') !!}",
            type: "{{ notify()->type() }}",
            @if (notify()->option('timer'))
                timer: {{ notify()->option('timer') }},
                showConfirmButton: false
            @endif
        });
    </script>
  @endif
</body>
</html>
