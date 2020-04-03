@extends('admin.template')
@section('content')
    adfbsdfbsdfbsd
    <div class="row align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h1 align="center">Тип пользователей на сайте</h1>
                    @if(session('success'))

                        <div class="alert alert-success" role="alert">
                            <button types="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    @endif
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
                            @foreach($typeUser as $typeUser)
                                <tr>
                                    <th scope="row">{{ $typeUser->id }}</th>
                                    <td>{{ $typeUser->name }}</td>
                                    <td><a class="btn btn-primary" href="{{ route('admin.types.edit', $typeUser->id) }}">Edit</a></td>
                                    <td><form action="{{ route('admin.types.destroy', $typeUser->id) }}" method="POST">
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
