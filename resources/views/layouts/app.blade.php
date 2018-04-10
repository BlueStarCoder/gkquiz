<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf_token" content="{{ csrf_token() }}">

  <title>GK Quiz Time</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" media="screen">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}" media="screen">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" />

  <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/quiz.css') }}">
  <link rel="shortcut icon" href="{{ asset('diploma.ico') }}" type="image/x-icon" />
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
    
    .btn {
      margin: 10px 30px 10px 0;
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
      margin: 30px;
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

    @media screen and (max-width: 580px) {
      .table {
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
  <div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name', 'Laravel') }}
          </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            &nbsp;
            @auth
            <li><a href="{{ route('record-search') }}" class="navbar-link">Record Search</a></li>
            <li><a href="{{ route('manage-questions') }}">Manage Questions</a></li>
            <li><a href="{{ route('get-students') }}">Manage Students</a></li>
            @endauth
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
            <li><a href="{{ route('index') }}">Start Test</a></li>
            @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu">
                <li>
                  <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
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
