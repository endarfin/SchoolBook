@extends('admin.template')
@section('content')
    <div class="row align-items-center ">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h1 align="center">Группы</h1>
                    @include('alert')
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Имя группы</th>
                                <th scope="col">Курс</th>
                                <th scope="col">Изменить</th>
                                <th scope="col">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                            <th scope="row">{{$group->id}}</th>
                            <td>{{$group->name}}</td>
                            <td>{{$group->courses->name}}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.groups.edit', $group->id) }}" role="button">Edit</a></td>
                            <td><form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-primary" type="submit">Delete</button>
                                </form></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="float-right"><a class="btn btn-primary" href="{{route('admin.groups.create')}}">Add</a></div>
                    @if($groups->total() > $groups->count())
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">

                            {{$groups->links()}}

                        </ul>
                    </nav>
                     @endif
                </div>

            </div>
        </div>
    </div>
@endsection
