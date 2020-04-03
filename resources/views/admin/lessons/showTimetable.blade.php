@extends('admin.template')
@section('content')
    <h1 align="center">Расписание</h1>
    <div class="row align-items-center ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table border="1">

                        @php

                $day1 = time();
               $day2 = time();
               $week = time();
               for ($i = 0; $i < 7; $i++) {
                echo "<tr>";
                echo "<th>".date("l", $week)."</th>";
                $day = $week;
                $week += 86400;
                for ($j=1; $j < 10; $j++) {
                  echo "<th>".date("d-m-y", $day )."</th>";
                  $day += 604800;
                }
                echo "</tr>";

                   for ($q=1; $q < 14; $q++) {

                                   foreach ($friday as $thu){
                                           if (date("d-m-y", $day1 ) == date("d-m-y", $thu )){
                                               echo "<tr>";
                                               echo "<th>".date("H:i", $thu)."</th>";

                                               for ($w=1; $w < 10; $w++) {

                                                   if ((date("d-m-y",  $day2 ) == date("d-m-y", $thu))){
                                                   echo "<th>".date("d-m H:i", $thu)."</th>";
                                                   }else{echo "<th>E</th>";}
                                                    $day2 += 604800;

                                               }
                                               $day2 = time();
                                               echo "</tr>";
                                           }
                                   }
                                   $day1 += 604800;
                   }
                  $day1 = $week;
               }
                        @endphp
                    </table>
                    <table>
                    @php



        foreach ($friday as $time){
            $rez [] = date("H:i", $time);
        }
array_unique($rez);





                    @endphp
                    </table>

                    @php


                    @endphp
                </div>

            </div>
        </div>
    </div>
@endsection
