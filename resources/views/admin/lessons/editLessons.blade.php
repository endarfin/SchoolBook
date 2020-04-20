
@extends('admin.template')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src = "{{ asset('/js/admin/lessonsAjax.js')}}"></script>
    <script src = "{{ asset('/js/admin/lessonsEditAjaxForm.js')}}"></script>
    <input type="hidden" name="id" id="lessons" value={{$lesson->id}}>
    <input type="hidden" id="url" value={{url('/')}}>
    <div class="row align-items-center ">
        <div class="container">
            <form action="" method="POST">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <div class="alert alert-danger" role="alert" id="false" style="display: none;"></div>
                        <div class="alert alert-success" role="alert" id="true" style="display: none;"></div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Группы</label>
                                <select class="form-control" name="group_id" id="group" required>
                                    <option value="{{$lesson->group_id}}">{{$lesson->Groups->name}}</option>
                                    @foreach($groups as $group)
                                            @if($group->id != $lesson->group_id)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endif
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Предмет</label>
                                <select class="form-control" name="subject_id" id="subject" required>
                                    <option value="{{$lesson->subject_id}}">{{$lesson->Subject->name}}</option>
                                    @foreach($subjects as $subject)
                                             @foreach( $subject->subjects as $subject)
                                                 @if($subject->id != $lesson->subject_id)
                                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                 @endif
                                            @endforeach
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Учителль</label>
                                <select class="form-control" name="user_id" id="teacher" required>
                                    <option value="{{$lesson->user_id}}">{{$lesson->User->name}} {{$lesson->User->surname}}</option>
                                    @foreach($teachers as $teacher)
                                            @if($teacher->user_id != $lesson->user_id)
                                                <option value="{{$teacher->user_id}}">
                                                    {{$teacher->User->name}} {{$teacher->User->surname}}
                                                </option>
                                            @endif
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Аудитероя</label>
                                <select class="form-control" name="class_room_id" id="classRoom" required>
                                    <option value="{{$lesson->class_room_id}}">{{$lesson->ClassRooms->name}}</option>
                                    @foreach($classRooms as $classRoom)
                                        @if($classRoom->id != $lesson->class_room_id)
                                        <option value="{{$classRoom->id}}">{{$classRoom->name}}</option>
                                        @endif
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Пара</label>
                                <select class="form-control" name="lesson" id="lesson" required>
                                    <option value="{{$lesson->lesson}}">#{{$lesson->lesson}} {{$lesson->TimeLessons->time}}</option>
                                    @foreach($timeLessons as $timeLesson)
                                        @if($timeLesson->id != $lesson->lesson)
                                        <option value="{{$timeLesson->id}}">#{{$timeLesson->id}} ({{$timeLesson->time}})</option>
                                        @endif
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label >Дата</label>
                                <input type="date" name="date_event" id="date"
                                       class="form-control" value={{$lesson->date_event}}>
                            </div>
                        </div>
                        <button type="button" id="button" class="btn btn-primary mb-2">Изменить</button>
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



