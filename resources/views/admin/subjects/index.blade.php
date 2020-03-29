@extends('admin.template')
@section('content')

<h1 align="center">Предметы</h1>

    <div class="container">
        <div class="row">
            <div class="col-8">

                <table class="table table-hover auto__table table-bordered ">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Название предмета</th>
                        <th scope="col">Изменить</th>
                        <th scope="col">Удалить</th>
                    </tr>
                    </thead>

                    <tbody class="table table-secondary">
                    @foreach($paginator as $item)
                        @php /** @var \App\Models\Subject $item */ @endphp
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.subjects.edit', $item->id) }}">Edit</a></td>
                            <td><a class="btn btn-primary" href="{{ route('admin.subjects.destroy', $item->id) }}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right"><a class="btn btn-primary" href="{{ route('admin.subjects.create') }}">Add</a></div><br>
        </div>

{{--        <nav class="navbar-toggleable-md navbar-light bg-faded">--}}
{{--            <a class="btn btn-primary" href="{{ route('admin.subjects.create') }}">Add</a>--}}
{{--        </nav>--}}

        @if ($paginator->total() > $paginator->count())

        <div class="row justify-content-end" >
            <div class="col-md-12">
                <div>
                    <div class="card-body">
                        {{ $paginator->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

@endsection
