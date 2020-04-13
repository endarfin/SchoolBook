
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
            <form action="{{route('admin.lessons.update', $lesson->id)}}" method="post">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Группы</label>
                                <select class="form-control" name="group_id" required>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}"
                                                @if(old('group_id', $lesson->group_id) == $group->id) selected @endif>
                                            {{$group->name}}
                                            ( @foreach( $group->subjects as $subjec)
                                                {{$subjec->name}}
                                            @endforeach
                                            )
                                        </option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Предмет</label>
                                <select class="form-control" name="subject_id" required>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}"
                                                @if(old('subject_id', $lesson->subject_id) == $subject->id) selected @endif>
                                            {{$subject->name}}
                                        </option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Учителль</label>
                                <select class="form-control" name="user_id" required>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}"
                                                @if(old('user_id', $lesson->user_id) == $teacher->id) selected @endif>
                                            {{$teacher->surname}}
                                            ( @foreach( $teacher->subjects as $subjec)
                                                {{$subjec->name}}
                                            @endforeach
                                            )
                                        </option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Аудитероя</label>
                                <select class="form-control" name="class_room_id" required>
                                    @foreach($classRooms as $classRoom)
                                        <option value="{{$classRoom->id}}"
                                                @if(old('class_room_id', $lesson->class_room_id) == $classRoom->id) selected @endif>
                                            {{$classRoom->name}}
                                        </option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Пара</label>
                                <select class="form-control" name="lesson" required>
                                    @foreach($timeLessons as $timeLesson)
                                        <option value="{{$timeLesson->id}}"
                                                @if(old('lesson', $lesson->lesson) == $timeLesson->id) selected @endif>
                                            #{{$timeLesson->id}} ({{$timeLesson->time}})
                                        </option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label >Дата</label>
                                <input type="date" name="date_event"
                                       class="form-control" value={{$lesson->date_event}}>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Изменить</button>
                    </div>
                    <div class="col-3">
                        <label for="formGroupExampleInput">Создано</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="{{$lesson->created_at}}" disabled>
                        <label for="formGroupExampleInput">Изменено</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="{{$lesson->updated_at}}" disabled>
                        <label for="formGroupExampleInput">Удалено</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="{{$lesson->deleted_at}}" disabled>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



