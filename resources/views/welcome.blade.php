<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5; url=/">


    <title></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        a {
            padding: 5px;
            margin-right: 40px;
            border: 1px solid #0b3e6f;
        }

    </style>
</head>
<body>

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth

                @if(Auth::user()->isStudent())
                    <strong>  <a href="{{ url('/') }}" style="color: #0b3e6f; text-decoration: none">Главная</a></strong>
                @elseif(Auth::user()->isTeacher())
                    <strong>  <a href="{{ url('/teacher/index') }}" style="color: #0b3e6f; text-decoration: none">Кабинет</a></strong>
                    <strong>  <a href="{{ url('/') }}" style="color: #0b3e6f; text-decoration: none">Главная</a></strong>
                @elseif(Auth::user()->isVisitor())
                    <strong>   <a href="{{ url('/') }}" style="color: #0b3e6f; text-decoration: none">Главная</a></strong>
                @elseif(Auth::user()->isAdministrator())
                    <strong><a href="{{ url('/admin/index') }}" style="color: #0b3e6f; text-decoration: none; cursor: pointer">Панель Администратора</a></strong>
                    <strong> <a href="{{ url('/') }}" style="color: #0b3e6f; text-decoration: none">Главная</a></strong>
                @endif

                <strong>
                    <a class="dropdown-item" href="{{ route('logout') }}" style="color: #0b3e6f; text-decoration: none"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                </strong>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            @else
                <strong>
                    <a href="{{ route('login') }}" style="color: #0b3e6f; text-decoration: none">Войти</a>
                </strong>

                @if (Route::has('register'))
                    <strong>
                        <a href="{{ route('register') }}" style="color: #0b3e6f; text-decoration: none">Регистрация</a>
                    </strong>
                @endif
            @endauth


        </div>
    @endif

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
        <div class="title m-b-md">

        </div>

        <div class="links">

        </div>
    </div>
</div>
</body>
</html>
