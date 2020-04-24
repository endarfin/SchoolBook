@extends('admin.template')
@section('content')
    <br><h1 align="center" style="font-style:italic">Добро пожаловать, Administrator</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    Панель управления
                </div>
                <table class="table">
                    <tr valign=bottom align="center">
                        <th>
                            <a href="{{route('admin.users.index')}}"><img src="{{ asset('/img/users.png')}}"
                                                                          width="75"
                                                                          height="75" border="0" alt="Пользователи"></a>
                            <div></div>
                        </th>
                        <th>
                            <div><a href="{{route('admin.lessons.store')}}"><img
                                        src="{{ asset('/img/timetable.png')}}" width="75"
                                        height="75" border="0" alt="Расписание"></a></div>
                        </th>
                        <th>
                            <div><a href="{{route('admin.groups.index')}}"><img src="{{ asset('/img/groups.png')}}"
                                                                                width="75"
                                                                                height="75" border="0" alt="Группы"></a>
                            </div>
                        </th>
                        <th>
                            <div><a href="{{ route('admin.courses.index') }}"><img
                                        src="{{ asset('/img/course.png')}}" width="75"
                                        height="75" border="0" alt="Курсы"></a></div>
                        </th>
                        <th>
                            <div><a href="{{ route('admin.subjects.index') }}"><img
                                        src="{{ asset('/img/subjects.png')}}" width="75"
                                        height="75" border="0" alt="Предметы"></a></div>
                        </th>
                        <th>
                            <div><a href="{{ route('admin.rooms.index') }}"><img src="{{ asset('/img/rooms.png')}}"
                                                                                 width="75"
                                                                                 height="75" border="0"
                                                                                 alt="Аудитории"></a></div>
                        </th>
                        <th>
                            <div><a href="{{route('admin.news.index')}}"><img src="{{ asset('/img/news.png')}}"
                                                                              width="75"
                                                                              height="75" border="0" alt="Новости"></a>
                            </div>
                        </th>
                    </tr>
                    <tr valign=bottom align="center">
                        <td>Пользователи</td>
                        <td>Расписание</td>
                        <td>Группы</td>
                        <td>Курсы</td>
                        <td>Предметы</td>
                        <td>Аудитории</td>
                        <td>Новости</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
