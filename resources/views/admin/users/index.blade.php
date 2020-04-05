@extends('admin.template')
@section('content')
    <div class="row align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-11">
                    <h1 align="center">Пользователи</h1>
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <button types="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Имя</th>
                                <th scope="col">Фамилия</th>
                                <th scope="col">Телефон</th>
                                <th scope="col">Почта</th>
                                <th scope="col"><a href="{{ route('admin.types.index') }}">Тип пользователя</a></th>
                                <th scope="col"><a href="{{ route('admin.groups.index') }}">Группа</a></th>
{{--                                <th scope="col">Логин</th>--}}
{{--                                <th scope="col">Пароль</th>--}}
                                <th scope="col">Изменить</th>
                                <th scope="col">Удалить</th>
                            </tr>
                        </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->surname }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->type->name }}</td>
                                    <td>{{ $user->group->name }}</td>
{{--                                    <td>{{ $user->login }}</td>--}}
{{--                                    <td>{{ $user->password }}</td>--}}
                                    <td><a class="btn btn-primary" href="{{ route('admin.users.edit', $user->id) }}">Edit</a></td>
                                    <td><form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-primary" types="submit">Delete</button>
                                        </form></td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                    <div class="float-right"><a class="btn btn-primary" href="{{ route('admin.users.create') }}">Add</a></div>
            @if ($users->total() > $users->count())
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{$users->links()}}
                    </ul>
                </nav>
            @endif
                </div>
            </div>
        </div>
    </div>
@endsection
