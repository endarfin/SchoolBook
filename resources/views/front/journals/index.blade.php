@extends('template')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-rigth">
                <div>Journal</div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-title">
                {{--                        <div>Subject: {{$lesson->subject->name}}</div>--}}
                {{--                        <div>Group: {{$lesson->groups->name}}</div>--}}
            </div>
            <table class="table table-bordered table-hover">

                {{--                <tr>--}}
                {{--                    <th rowspan="2">Student's List</th>--}}
                {{--                    @foreach($date as $date)--}}
                {{--                        <th colspan="2" class="text-center">{{$date->date}}</th>--}}
                {{--                    @endforeach--}}
                {{--                </tr>--}}


                {{--                @foreach($students as $student)--}}
                {{--                    <tr>--}}
                {{--                        <th>{{$student->surname }} {{ $student->name}}</th>--}}
                {{--                    </tr>--}}
                {{--                @endforeach--}}
                @php
                    echo '<thead>';
                        echo '<tr>';
                        echo '<th>Student</th>';
                        for ($i = 0; $i < $days; $i++) {
                            echo '<th>'.date("Y-m-d H:i:s", $day[$i]).'</th>';
                        }
                        echo '</tr>';
                    echo '</thead>';
                        echo '<tbody>';
                        //foreach ($students as $student) {
                         //   echo '<td>'.$student->surname.$student->name.'</td>';
                       // }
                            foreach ($schedule as $key => $value) {

                                echo '<td>'.$user[$key].'</td>';
                                for ($i = 0; $i < $days; $i++) {
                                    if (empty($value[$day[$i]])) {
                                        echo '<td> </td>';
                                    } else echo '<td>'.$value[$day[$i]].'</td>';
                                }
                                echo "</tr>";
                            }
                            echo '</tbody>';
                @endphp

            </table>
        </div>
    </div>
    <br>

    <div class="float-right">
        <a class="btn btn-outline-info btn-sm"
           href="{{ route('admin.users.index') }}">Back</a>
        <button type="submit" class="btn btn-outline-info btn-sm">Save</button>
    </div>

@endsection
