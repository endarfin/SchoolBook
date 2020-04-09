
@extends('admin.template')
@section('content')
    <h1 align="center">Изменить группу</h1>
    <div class="row align-items-center ">
        <div class="container">
            @if($errors->any())
                <div class="col-4">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="col-4">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{ session()->get('success') }}
                    </div>
                </div>
            @endif
            <form action="{{route('admin.lessons.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Группы</label>
                                <select class="form-control" name="group_id" required>
                                    <option value="" selected></option>
                                    @foreach($groups as $group)
                                        <option value={{$group->id}} {{ old('group_id') == $group->id ? 'selected' : '' }}>{{$group->name}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Предмет</label>
                                <select class="form-control" name="subject_id" required>
                                    <option value="" selected></option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{$subject->name}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Учителль</label>
                                <select class="form-control" name="user_id" required>
                                    <option value="" selected></option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}" {{ old('user_id') == $teacher->id ? 'selected' : '' }}>{{$teacher->surname}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Аудитероя</label>
                                <select class="form-control" name="class_room_id" required>
                                    <option value="" selected></option>
                                    @foreach($classRooms as $classRoom)
                                        <option value="{{$classRoom->id}}" {{ old('class_room_id') == $classRoom->id ? 'selected' : '' }}>{{$classRoom->name}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label >Дата</label>
                                <input type="datetime-local" name="date_event" max="3000-12-31"
                                       min="1000-01-01" class="form-control" value="{{old('date_event')}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Добавить</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection


