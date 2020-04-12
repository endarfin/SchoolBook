@extends('template')
@section('content')
    <h1 align="center">Расписание {{$nameTable}}</h1>
    <div class="row align-items-center ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover">
        @php
            for ($i = 0; $i < 7; $i++) {
                $www = '';
                $www .= '<thead><tr><th scope="col">' .$dayWeekRu[$i] . '</th>';
                for ($j = 1; $j < 10; $j++) {
                    $www .= '<th scope="col">' . date('d-m-y', strtotime("$j $dayWeek[$i]")) . '</th>';
                }
                echo $www .= "</tr></thead>";
                $uniqTime = $collectionTimeTable->where('day', $dayWeek[$i])
                    ->unique('time')
                    ->sortBy('time');
                foreach ($uniqTime as $time) {
                    $www = '';
                    $www .= '<tbody><tr><th scope="row">' . $time->time . '</th>';
                    for ($j = 1; $j < 10; $j++) {
                        $uniqueDay = $collectionTimeTable->where('day', $dayWeek[$i])->values();
                        $uniqueDay = $collectionTimeTable->where('date', date('d-m-Y', strtotime("$j $dayWeek[$i]")))->values();
                        $uniqueDayTami = $uniqueDay->where('time', $time->time);
                        if ($uniqueDayTami->isEmpty()){
                            $www .= '<td></td>';
                        }else{
                            foreach ($uniqueDayTami as $day) {
                                $room = $classRoomCollect->where('id', "$day->class_room_id")->first();
                                $subject = $subjectsCollect->where('id',"$day->subject_id" )->first();
                                $www .= "<td>" .$subject->name."<br>(". $room->name . ")</td>";
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
