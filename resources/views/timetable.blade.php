@extends('template')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h6>Группы</h6>
            @foreach($courses as $course)
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">{{$course->name}}</a>
                    </li>
                    @foreach( $course->groups as $group)
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('showTimetable',['name'=>'group_id','id'=>$group->id])}}">{{$group->name}}</a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
            <br>
        </div>
        <div class="col-md-8">
            <h6>Преподаватели</h6>
            <ul class="nav">
            @foreach($teachers as $teacher)
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('showTimetable',['name'=>'user_id','id'=>$teacher->id])}}">{{$teacher->name}} {{$teacher->surname}}</a>
                    </li>
            @endforeach
            </ul>
        </div>
    </div>
@endsection
