
@extends('admin.template')
@section('content')
    <h1 align="center">Изменить группу</h1>
    <div class="row align-items-center ">
        <div class="container">
            @if($errors->any())
                    <div class="col-4">
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first()}}
                        </div>
                    </div>
            @endif
            @if(session('success'))
                    <div class="col-4">
                        <div class="alert alert-success" role="alert">

                            {{session()->get('success')}}
                        </div>
                    </div>
            @endif
            <form action="{{ route('admin.groups.update', $group->id) }}" method="post">
                @method('PATCH')
                @csrf
            <div class="row">
                <div class="col-4">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Название группы</label>
                            <input type="text"
                                   class="form-control"
                                   id="formGroupExampleInput"
                                   name="name"
                                   value="{{old('name', $group->name)}}"
                                   minlength="3"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Курс</label>
                            <select class="form-control" name="course_id" required>
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}"
                                            @if(old('course_id', $group->course_id) == $course->id) selected @endif>
                                            {{$course->name}}
                                        </option>
                                    @endforeach
                            </select><br>
                            <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
                        </div>

                </div>
                <div class="col-3">
                    <label for="formGroupExampleInput">Создано</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" value="{{$group->created_at}}" disabled>
                    <label for="formGroupExampleInput">Изменено</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" value="{{$group->updated_at}}" disabled>
                    <label for="formGroupExampleInput">Удалено</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" value="{{$group->deleted_at}}" disabled>
                </div>

            </div>
            </form>
        </div>
</div>
@endsection



