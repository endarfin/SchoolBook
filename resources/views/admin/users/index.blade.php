@extends('admin.template')
@section('content')
    <div class="row align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <button types="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <br><table class="table table-bordered table-hover text-nowrap table-sm">
                        <thead>
                            <tr><th colspan="10">User List:
                                    <a class="btn btn-outline-info btn-sm" href="{{ route('admin.users.index') }}" >All</a>
                                    <a class="btn btn-outline-info btn-sm" href="{{ route('admin.users.index') }}?type=3" >Administrator</a>
                                    <a class="btn btn-outline-info btn-sm" href="{{ route('admin.users.index') }}?type=2" >Teacher</a>
                                    <a class="btn btn-outline-info btn-sm" href="{{ route('admin.users.index') }}?type=1" >Student</a>
                                    <div class="float-right"><a class="btn btn-outline-primary btn-sm" href="{{ route('admin.users.create') }}">Add</a></div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col"><a href="{{ route('admin.types.index') }}">Type</a></th>
                                <th scope="col"><a href="{{ route('admin.groups.index') }}">Group</a></th>
                                <th scope="col"><a href="{{ route('admin.subjects.index') }}">Subject</a></th>
                                <th scope="col">Action</th>
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
                                    <td>@foreach ($user->subjects as $subject)
                                               {{$subject->name}}<br>
                                        @endforeach
                                    </td>
                                    <td class="text-nowrap">
                                        <a class="btn badge badge-primary" href="{{ route('admin.users.show', $user->id) }}">View</a>
                                        <a class="btn badge badge-info" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn badge badge-danger" types="submit">Delete</button>
                                        </form></td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
            @if ($users->total() > $users->count())
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        {{$users->links()}}
                    </ul>
                </nav>
            @endif
                </div>
            </div>
        </div>
    </div>
@endsection
