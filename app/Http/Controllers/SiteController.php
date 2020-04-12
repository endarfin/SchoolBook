<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Repositories\classRoomRepository;
use App\Repositories\CoursesRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\usersRepository;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private $lessonsRepository;
    private $groupsRepository;
    private $classRoomRepository;
    private $subjectRepository;
    private $usersRepository;
    private $coursesRepository;


    public function __construct()
    {
        $this->lessonsRepository = app(lessonsRepository::class);
        $this->groupsRepository = app(GroupsRepository::class);
        $this->classRoomRepository = app(classRoomRepository::class);
        $this->subjectRepository = app(subjectRepository::class);
        $this->usersRepository = app(usersRepository::class);
        $this->coursesRepository = app(coursesRepository::class);
    }

    public function index()
    {
        //dd(__METHOD__);
    	return view('index');
    }

    public function timetable()
    {
        $courses = $this->coursesRepository->getAll();
        $teachers = $this->usersRepository->getAllTeacher();

       // dd(__METHOD__,$courses,$teachers);

    	return view('timetable',compact('courses', 'teachers'));
    }

    public function rank()
    {
    	return view('rank');
    }
    /**
     * @var \Illuminate\Support\Collection $collectionTimeTable
     */
    public function showTimetable($name, $id)
    {
        $groupsName = $this->groupsRepository->getEdit($id);

        $teacherName = $this->usersRepository->find($id);

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
        $dayWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $dayWeekRu =['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];
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
        $dayStart = strtotime('13-05-2020');
        return view('showTimetable',compact('dayWeek',
            'dayStart','collectionTimeTable',
            'subjectsCollect','classRoomCollect','nameTable', 'dayWeekRu'));
    }
}
