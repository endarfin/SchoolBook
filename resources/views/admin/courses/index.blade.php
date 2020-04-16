@extends('admin.template')
@section('content')
    <div class="row align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    @include('alert')
                    <h1 align="center">Перечень курсов</h1>
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
                                <th scope="col">Название</th>
                                <th scope="col">Изменить</th>
                                <th scope="col">Удалить</th>
                            </tr>
                        </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <th scope="row">{{ $course->id }}</th>
                                    <td>{{ $course->name }}</td>
                                    <td><a class="btn btn-primary" href="{{ route('admin.courses.edit', $course->id) }}">Edit</a></td>
                                    <td><form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                    <button class="btn btn-primary" types="submit">Delete</button>
                                        </form></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="float-right"><a class="btn btn-primary" href="{{ route('admin.courses.create') }}">Add</a></div>
                        @if ($courses->total() > $courses->count())
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    {{$courses->links()}}
                                </ul>
                            </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
