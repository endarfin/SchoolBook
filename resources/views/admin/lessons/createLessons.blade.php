
@extends('admin.template')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src = "{{ asset('/js/admin/lessonsAjax.js')}}"></script>
    <script src = "{{ asset('/js/admin/lessonsCreateAjaxForm.js')}}"></script>
    <div class="row align-items-center ">
        <div class="container">
            <form action="" method="">
                @csrf
                <div class="row justify-content-center" >
                    <div class="col-4">
                        <br><br>
                        <div class="alert alert-danger" role="alert" id="false" style="display: none;"></div>
                        <div class="alert alert-success" role="alert" id="true" style="display: none;"></div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Группы</label>
                                <select class="form-control" name="group_id" id="group" required>
                                    <option value="0" selected>Не выбрано</option>
                                    @foreach($groups as $group)
                                        <option value={{$group->id}} {{ old('group_id') == $group->id ? 'selected' : '' }}> {{$group->name}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Предмет</label>
                                <select class="form-control" name="subject_id" id="subject" required>
                                    <option value="0" selected>Не выбрано</option>
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Учитель</label>
                                <select class="form-control" name="user_id" id="teacher" required>
                                    <option value="0" selected>Не выбрано</option>
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Аудитория</label>
                                <select class="form-control" name="class_room_id" id="classRoom" required>
                                    <option value="0" selected>Не выбрано</option>
                                    @foreach($classRooms as $classRoom)
                                        <option value="{{$classRoom->id}}" {{ old('class_room_id') == $classRoom->id ? 'selected' : '' }}>
                                            {{$classRoom->name}}
                                        </option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Пара</label>
                                <select class="form-control" name="lesson" id="lesson" required>
                                    <option value="0" selected>Не выбрано</option>
                                    @foreach($timeLessons as $timeLesson)
                                        <option value="{{$timeLesson->id}}" {{ old('lesson') == $timeLesson->id ? 'selected' : '' }}>
                                            #{{$timeLesson->id}} ({{$timeLesson->time}})
                                        </option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label >Дата</label>
                                <input type="date" name="date_event" id="date"
                                       class="form-control" value="{{old('date_event')}}">
                            </div>
                        </div>
                        <button type="button" id="button" class="btn btn-primary mb-2">Добавить</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection



