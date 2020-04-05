@extends('admin.template')
@section('content')
    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
        @method('PATCH')
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
                        <div class="card-body">
                            <div class="card-title">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                                    </li>
                                </ul>
                                <br>
                                <div class="float-right">ID: {{ $user->id }}</div>
                                <div class="tab-content">
                                    <div class="form-group">
                                        <input name="name" placeholder="Имя" type="text" class="form-control" value="{{  $user->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="surname" value="{{  $user->surname }}" placeholder="Фамилия" type="text" class="form-control"  required>
                                    </div>
                                    <div class="form-group">
                                        <input name="phone" value="{{ $user->phone }}" placeholder="Телефон, для примера 0986706899" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="email" value="{{  $user->email }}" placeholder="Почта" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="type_user_id" type="text" required>
                                            <option value="" disabled selected hidden>Тип пользователя</option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="group_id" type="text" required>
                                            <option value="" disabled selected hidden>Группа</option>
                                            <option value="">нет</option>
                                            @foreach($groups as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input name="login" value="{{  $user->login }}" placeholder="Логин" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="password" value="{{  $user->password }}" placeholder="Пароль" type="text" class="form-control" required>
                                    </div>
                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('admin.users.index') }}" >Back</a>
                                        <button type="submit" class="btn btn-primary" >Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
