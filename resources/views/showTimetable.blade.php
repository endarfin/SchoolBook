@extends('template')
@section('content')
    <h1 align="center">Расписание {{$nameTable}}</h1>
    <div class="row align-items-center ">
        <div class="container">
            <div class="row">
                <div class="col-14">
                    <table class="table table-hover">
        @php
            for ($i = 0; $i < 7; $i++) {
                $www = '';
                $www .= '<thead><tr><th scope="col">' .$dayWeekRu[$i] . '</th>';
                for ($j = 1; $j < 10; $j++) {
                    $www .= '<th scope="col">' . date('d-m-y', strtotime("$j $dayWeek[$i]")) . '</th>';
                }
                echo $www .= "</tr></thead>";
                $uniqlessons = $collectionTimeTable->where('day', $dayWeek[$i])
                    ->unique('lesson')
                    ->sortBy('lesson');
                foreach ($uniqlessons as $lesson) {
                    $lessontime = $timeLessonsCollect->where('id', $lesson->lesson)->first();
                    $www = '';
                    $www .= '<tbody><tr><th scope="row">№' . $lesson->lesson .' - '.$lessontime->time . '</th>';
                    for ($j = 1; $j < 10; $j++) {
                        $uniqueDay = $collectionTimeTable->where('day', $dayWeek[$i])->values();
                        $uniquelesson = $uniqueDay->where('lesson', $lesson->lesson);
                        $uniqueDaylesson = $uniquelesson->where('date', date('Y-m-d', strtotime("$j $dayWeek[$i]")));
                        //dd($uniqueDay,$uniquelesson,$uniqueDaylesson,$lesson->lesson,date('Y-d-m', strtotime("$j $dayWeek[$i]")));
                        if ($uniqueDaylesson->isEmpty()){
                            $www .= '<td></td>';
                        }else{foreach ($uniqueDaylesson as $day) {
                                $room = $classRoomCollect->where('id', "$day->class_room_id")->first();
                                $subject = $subjectsCollect->where('id',"$day->subject_id" )->first();
                                $www .= "<td>" .$subject->name."<br>". $room->name . "</td>";
                            }
                        }
                    }
                   echo $www .= '</tr></tbody>';
                }
            }
        @endphp
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
