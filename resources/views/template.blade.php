<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}">


    <title>AcademyBook</title>
</head>

<body>
<div class="row align-items-start">
    <div class="col alert alert-light" id="header">
        <div class="float-left">
            <nav class="nav">
                <a class="nav-link" href="/" disabled>AcademyBook</a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="       false">Наша Академия</a>
                    <div class="dropdown-menu alert-light">
                        <a class="dropdown-item" href="#">Преподаватели</a>
                        <a class="dropdown-item" href="#">Студенты</a>
                        <a class="dropdown-item" href="#">О нас</a>
                    </div>
                </li>
                <a class="nav-link" href="{{route('Timetable')}}">Расписание</a>
                <a class="nav-link" href="{{route('showJournal')}}">Электронный журнал</a>
                <a class="nav-link" href="{{ route('showCurrentLesson') }}">Начать урок</a>
                <!-- <a class="nav-link" href="group">Преподаватели</a> -->
            </nav>
        </div>
        <div class="float-right ">
            <nav class="nav">
                <a class="nav-link" href="#">Личный кабинет</a>
                <a class="nav-link" href="login">Login</a>
                <a class="nav-link" href="register">Register</a>
                @if(Auth::user() &&  Auth::user()->type_user_id == 3)
                    <a class="nav-link" href="/admin">Administrator</a>
                @endif
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div>@yield('content')</div>
</div>
<div>
    <footer id="footer" class="footer navbar-fixed-bottom"> © 2020 Copyright: <a class="copy" href=""> LEXA & PETROV</a>
    </footer>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</html>
