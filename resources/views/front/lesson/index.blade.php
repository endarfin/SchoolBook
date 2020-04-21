@extends('template')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                                TODAY: {{$date}}
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-row">
                            <form action="{{ route('showCurrentLesson') }}" class="form-inline">

                                <select name="group_id" id="group_id" class="form-control" required>
                                    <option value="" selected>{{ __('Select group') }}</option>
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}"
                                                @if((!empty($group_id)) && ($group->id == $group_id)) selected @endif>{{$group->name}}
                                        </option>
                                    @endforeach
                                </select>&nbsp;

                                <select name="subject_id" id="subject_id" class="form-control" required>
                                    <option value="">{{ __('Select subject') }} </option>
                                    @foreach ($subjects as $subject)
                                        <option
                                            value="{{$subject->id}}"
                                            @if((!empty($subject_id)) && ($subject->id == $subject_id)) selected @endif>{{$subject->name}} </option>
                                    @endforeach
                                </select>&nbsp;

                                <select name="number" id="number" class="form-control" required>
                                    <option value="">{{ __('Select lesson') }} </option>
                                    @foreach ($lessons as $lesson)
                                        <option
                                            value="{{$lesson->number}}"
                                            @if((!empty($number)) && ($lesson->number == $number)) selected @endif>
                                            № {{$lesson->number}} : {{$lesson->time}} </option>
                                    @endforeach
                                </select>&nbsp;

                                <button type="submit" class="btn btn-info">Select</button>
                            </form>
                        </div>

                    </div>
                    <form action="{{ route('saveCurrentLesson') }}" name = "datas" method="post">
                        @csrf
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th>Students</th>
                            <th>  <div> Marks
                                    <button type="submit" class="btn btn-danger btn-sm">Save</button>
                                </div> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->surname}} {{$student->name}}</td>
                                <td>
                                    <select name=data[mark][] id="mark">
                                        <option value="" selected></option>
                                        <option value="n">n</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                    <input type="hidden" name=data[lessons_id][] value="{{ $lesson_id }}">
                                    <input type="hidden" name=data[student_id][] value="{{ $student->id }}">


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
