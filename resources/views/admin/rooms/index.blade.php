@extends('admin.template')
@section('content')
    <div class="row align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h1 align="center">Аудитории</h1>
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
                            @foreach($rooms as $room)
                                <tr>
                                    <th scope="row">{{ $room->id }}</th>
                                    <td>{{ $room->name }}</td>
                                    <td><a class="btn btn-primary" href="{{ route('admin.rooms.edit', $room->id) }}">Edit</a></td>
                                    <td><form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                    <button class="btn btn-primary" types="submit">Delete</button>
                                        </form></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="float-right"><a class="btn btn-primary" href="{{ route('admin.rooms.create') }}">Add</a></div>
                        @if ($rooms->total() > $rooms->count())
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    {{$rooms->links()}}
                                </ul>
                            </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
