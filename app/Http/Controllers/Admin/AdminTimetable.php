<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\classRoomRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\usersRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;

class AdminTimetable extends Controller
{
    private $lessonsRepository;
    private $groupsRepository;
    private $classRoomRepository;
    private $subjectRepository;
    private $usersRepository;


    public function __construct()
    {
        $this->lessonsRepository = app(lessonsRepository::class);
        $this->groupsRepository = app(GroupsRepository::class);
        $this->classRoomRepository = app(classRoomRepository::class);
        $this->subjectRepository = app(subjectRepository::class);
        $this->usersRepository = app(usersRepository::class);


    }

    /**
     * @var \Illuminate\Support\Collection $collectionTimeTable
     */
    public function showTimetable($name, $id)
    {
        $groupsName = $this->groupsRepository->getEdit($id);

        $teacherName = $this->usersRepository->getEdit($id);

        $classRoom = $this->classRoomRepository->getForComboBox();
        $classRoomCollect = Collect($classRoom);

        $subjects = $this->subjectRepository->getForComboBox();
        $subjectsCollect = Collect($subjects);

        $timeTable = $this->lessonsRepository->ShowTable($name, $id);
        $collectionTimeTable = Collect($timeTable);
        $collectionTimeTable->transform(function ($item) {
            $newItem = new \StdClass();
            $newItem->date = date("d-m-Y", $item->date_event);
            $newItem->time = date("H:i", $item->date_event);
            $newItem->group_id = $item->group_id;
            $newItem->class_room_id = $item->class_room_id;
            $newItem->subject_id = $item->subject_id;
            $newItem->user_id = $item->user_id;
            $newItem->day = date('l', $item->date_event);
            return $newItem;
        });
//        $collectionTimeTable->toArray();
//        dd($collectionTimeTable);
        $dayWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        switch ($name) {
            case 'group_id':
                $nameTable = $groupsName->name;
                break;
            case 'class_room_id':
                $table = $classRoomCollect->where('id', "$id")->first();
                $nameTable = $table->name;
                break;
            case 'user_id':
                $nameTable = $teacherName->surname;
                break;
        }

        echo '<table border="1">'. "<tr><th colspan='10'>".$nameTable."</th></tr>";

        for ($i = 0; $i < 7; $i++) {
            $www = '';
            $www .= "<tr><th>" .$dayWeek[$i] . "</th>";
            for ($j = 1; $j < 10; $j++) {
                $www .= "<th>" . date('d-m-y', strtotime("$j $dayWeek[$i]")) . "</th>";
            }
            echo $www .= "</tr>";
            $uniqTime = $collectionTimeTable->where('day', $dayWeek[$i])
                ->unique('time')
                ->sortBy('time');
            foreach ($uniqTime as $time) {
//                if($i !=0){
//                    $day1 = time() + (86400 * $i);
//                }else($day1 = time());
                $www = '';
                $www .= "<tr><th>" . $time->time . "</th>";
                for ($j = 1; $j < 10; $j++) {
                    $uniqueDay = $collectionTimeTable->where('day', $dayWeek[$i])->values();
                    $uniqueDay = $collectionTimeTable->where('date', date('d-m-Y', strtotime("$j $dayWeek[$i]")))->values();
                    $uniqueDayTami = $uniqueDay->where('time', $time->time);
                    //dd($uniqueDay, $time->time, $uniqueDayTami);

                    if ($uniqueDayTami->isEmpty()){
                        $www .= "<th></th>";
                    }else{
                        foreach ($uniqueDayTami as $day) {
                            $room = $classRoomCollect->where('id', "$day->class_room_id")->first();
                            $subject = $subjectsCollect->where('id',"$day->subject_id" )->first();
                            $www .= "<th>" .$subject->name."<br>(". $room->name . ")</th>";
                        }
                    }
                }
                echo $www .= '</tr>';
            }
        }
        echo '</table>';
        //return view('admin.lessons.showTimetable');
    }
}
