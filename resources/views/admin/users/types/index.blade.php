@extends('admin.template')
@section('content')
    <div class="row align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h1 align="center">Тип пользователей на сайте</h1>
                    @include('alert')
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Тип пользователя</th>
                                <th scope="col">Изменить</th>
                                <th scope="col">Удалить</th>
                            </tr>
                        </thead>
                            <tbody>
                            @foreach($types as $type)
                                <tr>
                                    <th scope="row">{{ $type->id }}</th>
                                    <td>{{ $type->name }}</td>
                                    <td><a class="btn btn-primary" href="{{ route('admin.types.edit', $type->id) }}">Edit</a></td>
                                    <td><form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                    <button class="btn btn-primary" types="submit">Delete</button>
                                        </form></td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                    <div class="float-right"><a class="btn btn-primary" href="{{ route('admin.types.create') }}">Add</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
