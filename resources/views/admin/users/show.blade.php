@extends('admin.template')
@section('content')
        <br>
        <div class="container">
            @include('alert')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">{{$user->type->name}}: {{$user->surname}} {{$user->name}}</div>
                            <div class="float-right">ID: {{ $user->id }}</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                                    </li>
                                </ul>
                                <br>
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{  $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Surname</th>
                                                <td>{{  $user->surname }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{  $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Type</th>
                                                <td>{{$user->type->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Subject</th>
                                                <td>
                                                    @foreach ($user->subjects as $subject)
                                                            <div>{{$subject->name}}</div>
                                                        @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                            <th>Group</th>
                                            <td>{{$user->group->name}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="float-right">
                                        <a class="btn btn-outline-info btn-sm" href="{{ route('admin.users.index') }}" >Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
