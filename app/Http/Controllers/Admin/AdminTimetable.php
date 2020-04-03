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
                    $monday[] = $table->date_event ;
                    break;
                case 'Tuesday':
                    $tuesday[] = $table->date_event ;
                    break;
                case 'Wednesday':
                    $wednesday[] = $table->date_event ;
                    break;
                case 'Thursday':
                    $thursday[] = $table->date_event ;
                    break;
                case 'Friday':
                    $friday[] = $table->date_event ;
                    break;
                case 'Saturday':
                    $saturday[] = $table->date_event ;
                    break;
                case 'Sunday':
                    $sunday[] = $table->date_event ;
                    break;
            }
        }
        asort( $thursday);
       //dd(__METHOD__, $timetable, $thursday);
        return view('admin.lessons.showTimetable',
            compact('timetable', 'sunday', 'saturday', 'friday', 'thursday', 'wednesday', 'tuesday', 'monday'));

    }
}
