<?php

namespace App\Http\Controllers;

use App\Repositories\classRoomRepository;
use App\Repositories\CoursesRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\TimeLessonsRepository;
use App\Repositories\usersRepository;

class SiteController extends Controller
{
    private $lessonsRepository;
    private $groupsRepository;
    private $classRoomRepository;
    private $subjectRepository;
    private $usersRepository;
    private $coursesRepository;
    private $timeLessonsRepository;
    private $newsRepository;


    public function __construct()
    {
        $this->lessonsRepository = app(lessonsRepository::class);
        $this->groupsRepository = app(GroupsRepository::class);
        $this->classRoomRepository = app(classRoomRepository::class);
        $this->subjectRepository = app(subjectRepository::class);
        $this->usersRepository = app(usersRepository::class);
        $this->coursesRepository = app(coursesRepository::class);
        $this->timeLessonsRepository = app(TimeLessonsRepository::class);
        $this->newsRepository = app(NewsRepository::class);
}

    public function index()
    {
        $allNews = $this->newsRepository->getAllWithPaginateIndex(9);
        //dd(__METHOD__, $allNews);
    	return view('index', compact('allNews'));
    }

    public function news($slug)
    {
        $news = $this->newsRepository->findNews($slug);
        $bracingNews = $this->newsRepository->bracingNews();

        return view('news', compact('news', 'bracingNews'));
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

        $timeLessons = $this->timeLessonsRepository->getAll();
        $timeLessonsCollect = Collect($timeLessons);
        //dd($timeLessonsCollect);
        $classRoom = $this->classRoomRepository->getForComboBox();
        $classRoomCollect = Collect($classRoom);

        $subjects = $this->subjectRepository->getForComboBox();
        $subjectsCollect = Collect($subjects);

        $timeTable = $this->lessonsRepository->ShowTable($name, $id);
        $collectionTimeTable = Collect($timeTable);
        $collectionTimeTable->transform(function ($item) {
            $newItem = new \StdClass();
            $newItem->date = substr($item->date_event,0,-9);
            $newItem->group_id = $item->group_id;
            $newItem->lesson = $item->lesson;
            $newItem->class_room_id = $item->class_room_id;
            $newItem->subject_id = $item->subject_id;
            $newItem->user_id = $item->user_id;
            $newItem->day = date('l', strtotime($item->date_event));
            return $newItem;
        });
        //dd($timeTable,$collectionTimeTable);
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
            'subjectsCollect','classRoomCollect','nameTable', 'dayWeekRu', 'timeLessonsCollect'));
    }
}
