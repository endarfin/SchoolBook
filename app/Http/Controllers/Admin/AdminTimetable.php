<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\LessonsRepository;
use Illuminate\Http\Request;

class AdminTimetable extends Controller
{
    private $lessonsRepository;

    public function __construct()
    {
        $this->lessonsRepository = app(lessonsRepository::class);
    }

    public function showTimetable($name, $id)
    {
        $timetable = $this->lessonsRepository->ShowTable($name, $id);
        foreach ($timetable as $table) {
            //$Monday[] = $table->date_event;
            switch (date("l", $table->date_event)) {
                case 'Monday':
                    $monday[] = $table->date_event;
                    break;
                case 'Tuesday':
                    $tuesday[] = $table->date_event;
                    break;
                case 'Wednesday':
                    $wednesday[] = $table->date_event;
                    break;
                case 'Thursday':
                    $thursday[] = $table->date_event;
                    break;
                case 'Friday':
                    $friday[] = $table->date_event;
                    break;
                case 'Saturday':
                    $saturday[] = $table->date_event;
                    break;
                case 'Sunday':
                    $sunday[] = $table->date_event;
                    break;
            }
        }

        //dd(__METHOD__, $timetable, $thursday);
//        return view('admin.lessons.showTimetable',
//            compact('timetable', 'sunday', 'saturday', 'friday', 'thursday', 'wednesday', 'tuesday', 'monday'));
        foreach ($tuesday as $time){
            $rez [] = date("H:i", $time);
        }
        $unique = array_unique($rez);

        echo '<table border="1">';

        $aa = 0;
        $a1 = 0;
                $ww = '<th>' ;
                $day1 = time();
               $day2 = time();
               $week = time();
               for ($i = 0; $i < 1; $i++) {
                   echo "<tr>";
                   echo "<th>".date("l", $week)."</th>";
                   $day = $week;
                   $week += 86400;
                   for ($j=1; $j < count($tuesday); $j++) {
                       echo "<th>".date("d-m-y", $day )."</th>";
                       $day += 604800;
                   }
                   echo "</tr>";
                   foreach ($unique as $un) {
                       $www = '';
                       $www .= "<tr><th>".$un."</th>";
                       for ($e = 1; $e < count($tuesday); $e++) {
                            $a = 1;
                           foreach ($tuesday as $tues) {

                               if (date("d-m-y", $day1) == date("d-m-y", $tues)) {
                                   $aa = 1;
                                   if (date("H:i", $tues) == $un) {
                                       $aa = 0;
                                       $www .= "<th>" .'('.$aa.')'.date("d-m-y", $tues) . "</th>";
                                   }
                               }if ((date("d-m-y", $tues) != date("d-m-y", $day1)) && ($aa == '1') && $a == 1){$www .= "<th>$aa</th>";$aa = 0;}
                               //if(($aa == 1) && (date("H:i", $tues) == $un)){$aa = 0;}

                               $a = 0;
                           }

                           $day1 += 604800;
                       }

                       $www .= '</tr>';
                       echo $www;
                       $day1 = time();
                   }
                   $day1 = $week;


               }

        echo '</table>';

        echo '<table border="1">';
        foreach ($unique as $un)
        {
            $www = '' ;
            $www .= "<tr><th>++".$un."</th>";
            foreach ($tuesday as $tues)
            {
                if(date("H:i", $tues ) == $un)
                {
                    $www .= "<th>"."d---".date("d-m-y", $tues)."</th>";
                }
            }
            $day1 += 604800;
            $www .= '</tr>' ;
            echo $www;

        }
        echo '</table>';

    }
}
