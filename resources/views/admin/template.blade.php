<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
{{--      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/admin/style.css')}}">
    <title>Administrator</title>
</head>
<body>
<header class="header" role="banner">
    <!--
    <h1 class="logo">
    <a href="#">Terence <span>Devine</span></a>
    </h1>
    -->
    <div class="nav-wrap">
        <nav class="main-nav" role="navigation">
            <ul class="unstyled list-hover-slide">
                <li><a href="/admin">На главную</a></li>
                <li><a href="/">На сайт</a></li>
                <li><a href="{{route('admin.users.index')}}">Пользователи</a></li>
                <li><a href="{{route('admin.lessons.store')}}">Расписание</a></li>
                <li><a href="{{route('admin.groups.index')}}">Группы</a></li>
                <li><a href="{{ route('admin.courses.index') }}">Курсы</a></li>
                <li><a href="{{ route('admin.subjects.index') }}">Предметы</a></li>
                <li><a href="{{ route('admin.rooms.index') }}">Аудитории</a></li>
                <li><a href="{{ route('admin.slider.index') }}">Слайды</a></li>
                <li><a href="{{route('admin.news.index')}}">Опубликовать новость</a></li>
            </ul>
        </nav>
    </div>
</header>

<article>
    <div>@yield('content')</div>
</article>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

