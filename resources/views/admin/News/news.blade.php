@extends('admin.template')
@section('content')
    <h1 align="center">Новости</h1>
    <div class="row align-items-center ">
        <div class="container">
            <div class="row">
                <div class="col-10">
                    @include('alert')
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Категория</th>
                            <th scope="col">Автор</th>
                            <th scope="col">Описание</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allNews as $news )
                            <tr {{$news->is_published == 0 ? 'class = table-active' : '' }}>
                                <th scope="row">{{$news->id}}</th>
                                <td>{{$news->categories->name}}</td>
                                <td>{{$news->author->name}} {{$news->author->surname}}</td>
                                <td>{{$news->title}}</td>
                                <td><a class="btn btn-primary" href="{{ route('admin.news.edit', $news->id) }}"
                                       role="button">Edit</a></td>
                                <td>
                                    <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-primary" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($allNews->total() > $allNews->count())
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                {{$allNews->links()}}
                            </ul>
                        </nav>
                    @endif
                </div>
                <div class="col-2">
                    <div class="card">
                        <nav class="nav nav-pills nav-justified">
                            <a class="nav-item nav-link active" href="{{route('admin.news.create')}} ">Создать новость</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

