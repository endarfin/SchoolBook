
@extends('admin.template')
@section('content')
    <h1 align="center">Добавить группу</h1>
    <div class="row align-items-center ">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <form method="post" action="{{route('admin.groups.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="formGroupExampleInput">Название группы</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Курс</label>
                            <select class="form-control" name="course_id" required>
                                <option></option>
                                @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                                @endforeach
                            </select><br>
                            <button type="submit" class="btn btn-primary mb-2">Создать</button>
                        </div>
                    </form>
                </div>
                <div class="col-4">

                </div>
            </div>
        </div>
        </div>
@endsection


