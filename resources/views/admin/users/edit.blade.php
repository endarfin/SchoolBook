@extends('admin.template')
@section('content')
    <form action="{{ route('admin.users.update', [$user->id]) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <br>
        <br><div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <br>@include('alert')
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">{{$user->type->name}}: {{$user->surname}} {{$user->name}}</div>
                            <div class="float-right">ID: {{ $user->id }}</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Main</a>
                                    </li>
                                </ul>
                                <br>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td><input name="name" type="text" class="form-control"
                                                   value="{{  $user->name }}" required></td>
                                    </tr>
                                    <tr>
                                        <th>Surname</th>
                                        <td><input name="surname" value="{{  $user->surname }}" type="text"
                                                   class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td><input name="phone" value="{{ $user->phone }}" type="text"
                                                   class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><input name="email" value="{{  $user->email }}" type="text"
                                                   class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>
                                            <select class="form-control" name="type_user_id" id="type" type="text" required>
                                                <option value="{{$user->type->id}}"
                                                        hidden>{{$user->type->name}}</option>
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
                                                <option value="">---no---</option>
                                                @foreach($subjects as $id => $subjects)
                                                    <option
                                                        value="{{ $id }}" {{ (in_array($id, old('$subjects', [])) || $user->subjects->contains($id)) ? 'selected' : '' }}>{{ $subjects }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Group</th>
                                        <td>
                                            <select class="form-control" name="group_id" type="text" >
                                                <option value="{{$user->group->id}}" selected>{{$user->group->name}}</option>
                                                <option value="">---no---</option>
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
