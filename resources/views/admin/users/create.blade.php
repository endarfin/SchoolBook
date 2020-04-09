@extends('admin.template')
@section('content')
    <form action="{{ route('admin.users.store') }}" method="post">
        @csrf
        <br>
        <div class="container">
            @if($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {!! $errors->first() !!}
                        </div>
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-rigth">New User</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные
                                            данные</a>
                                    </li>
                                </ul>
                                <br>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td><input name="name" type="text" class="form-control"
                                                   value="{{ old('name') }}" required></td>
                                    </tr>
                                    <tr>
                                        <th>Surname</th>
                                        <td><input name="surname" value="{{ old('surname') }}" type="text"
                                                   class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td><input name="phone" value="{{ old('phone') }}" type="text"
                                                   class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><input name="email" value="{{ old('email') }}" type="text"
                                                   class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th>Login</th>
                                        <td><input name="login" type="text" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td><input name="password" type="password" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>

                                            <select class="form-control" name="type_user_id" type="text" required>
                                                <option value="" disabled selected hidden>User's type</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Subject</th>
                                        <td>
                                            <select class="form-control" name="subjects[]" multiple type="text">
{{--                                                <option value=""></option>--}}
                                                @foreach($subjects as $id => $subjects)
                                                    <option
                                                        value="{{ $id }}" {{ (in_array($id, old('$subjects', []))) ? 'selected' : '' }}>{{ $subjects }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Group</th>
                                        <td>
                                            <select class="form-control" name="group_id" type="text" required>
                                                <option value="" disabled selected hidden>Группа</option>
                                                @foreach($groups as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            </select>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    <a class="btn btn-outline-info btn-sm"
                                       href="{{ route('admin.users.index') }}">Back</a>
                                    <button type="submit" class="btn btn-outline-info btn-sm">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
