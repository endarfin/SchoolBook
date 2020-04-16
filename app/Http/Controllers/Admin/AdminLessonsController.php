<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonsRequest;
use App\Repositories\classRoomRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\groupSubjectRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\subjectRepository;
use App\Repositories\teacherSubjectRepository;
use App\Repositories\TimeLessonsRepository;
use App\Repositories\usersRepository;


class AdminLessonsController extends Controller
{

    private $groupsRepository;
    private $lessonsRepository;
    private $subjectRepository;
    private $usersRepository;
    private $classRoomRepository;
    private $groupSubjectRepository;
    private $teacherSubjectRepository;
    private $timeLessonsRepository;

    public function __construct()
    {
        $this->groupsRepository = app(GroupsRepository::class);
        $this->lessonsRepository = app(LessonsRepository::class);
        $this->subjectRepository = app(subjectRepository::class);
        $this->usersRepository = app(usersRepository::class);
        $this->classRoomRepository = app(classRoomRepository::class);
        $this->groupSubjectRepository = app(groupSubjectRepository::class);
        $this->teacherSubjectRepository = app(teacherSubjectRepository::class);
        $this->timeLessonsRepository = app(TimeLessonsRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = $this->lessonsRepository->getAllWithPaginate(10);
        //dd($lessons);
        return view('admin.lessons.lessons', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = $this->groupsRepository->getForComboBox();
        $subjects = $this->subjectRepository->getForComboBox();
        $teachers = $this->usersRepository->getTeacherForComboBox();
        $classRooms = $this->classRoomRepository->getForComboBox();
        $timeLessons = $this->timeLessonsRepository->getAll();
        return view('admin.lessons.createLessons', compact('groups', 'subjects', 'teachers', 'classRooms', 'timeLessons'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonsRequest $request)
    {
        $lessons = $request;
        $groupSubjects = $this->groupSubjectRepository->find($lessons);
        $teacherSubject = $this->teacherSubjectRepository->find($lessons);
        $freeTeacherTime = $this->lessonsRepository->freeTeacherTime($lessons);
        $freeGroupTime = $this->lessonsRepository->freeGroupTime($lessons);
        $freeClassRoomTime = $this->lessonsRepository->freeClassRoomTime($lessons);
        $exist = $this->lessonsRepository->exist($lessons);

        $result = false;
        if ($groupSubjects) {
            if ($teacherSubject){
                if (!$exist){
                    if (!$freeTeacherTime){
                        if (!$freeGroupTime){
                            if (!$freeClassRoomTime){
                                $result = $this->lessonsRepository->lessonCreated($lessons);
                                }else{return back()
                                ->withErrors(['msg' => 'Кабинет в это времязанят'])
                                ->withInput();}
                            }else{return back()
                                ->withErrors(['msg' => 'У группы уже запланирован урок в это время'])
                                ->withInput();}
                        }else{return back()
                            ->withErrors(['msg' => 'У преподавателя уже запланирован урок в это время'])
                            ->withInput();}
                }else{return back()
                    ->withErrors(['msg' => 'Такой урок уже есть'])
                    ->withInput();}
                }else{return back()
                    ->withErrors(['msg' => 'Преподаватель не проподает такой придмет'])
                    ->withInput();}
            }else{return back()
                ->withErrors(['msg' =>'У группы нет такого предмета'])
                ->withInput();}

        if ($result) {
            return redirect()
                ->route('admin.lessons.edit', $result->id)
                ->with(['success' => 'Успешно создано']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка соханения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = $this->lessonsRepository->getEdit($id);
        $groups = $this->groupsRepository->getForComboBox();
        $subjects = $this->subjectRepository->getForComboBox();
        $teachers = $this->usersRepository->getTeacherForComboBox();
        $classRooms = $this->classRoomRepository->getForComboBox();
        $timeLessons = $this->timeLessonsRepository->getAll();
        //dd( $timeLessons);
        return view('admin.lessons.editLessons', compact('lesson', 'groups', 'subjects', 'teachers', 'classRooms', 'timeLessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonsRequest $request, $id)
    {
        $ed_lesson = $this->lessonsRepository->getEdit($id);
        if (empty($ed_lesson)) {
            return back()
                ->withErrors(['msg' => "Запись id={$id} не найдена"])
                ->withInput();
        }

        $groupSubjects = $this->groupSubjectRepository->find($request);
        $teacherSubject = $this->teacherSubjectRepository->find($request);
        $freeTeacherTime = $this->lessonsRepository->freeTeacherTime($request);
        $freeGroupTime = $this->lessonsRepository->freeGroupTime($request);
        $freeClassRoomTime = $this->lessonsRepository->freeClassRoomTime($request);
        $exist = $this->lessonsRepository->exist($request);

        $result = false;
        if ($groupSubjects) {
            if ($teacherSubject){
                if (!$exist){
                    if (!$freeTeacherTime){
                        if (!$freeGroupTime){
                            if (!$freeClassRoomTime){
                                $result = $this->lessonsRepository->upDate($ed_lesson, $request);
                            }else{return back()
                                ->withErrors(['msg' => 'Кабинет в это времязанят'])
                                ->withInput();}
                        }else{return back()
                            ->withErrors(['msg' => 'У группы уже запланирован урок в это время'])
                            ->withInput();}
                    }else{return back()
                        ->withErrors(['msg' => 'У преподавателя уже запланирован урок в это время'])
                        ->withInput();}
                }else{return back()
                    ->withErrors(['msg' => 'Такой урок уже есть'])
                    ->withInput();}
            }else{return back()
                ->withErrors(['msg' => 'Преподаватель не проподает такой придмет'])
                ->withInput();}
        }else{return back()
            ->withErrors(['msg' =>'У группы нет такого предмета'])
            ->withInput();}


        if ($result) {
            return redirect()
                ->route('admin.lessons.edit', $ed_lesson->id)
                ->with(['success' => 'Успешно измененно']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка соханения'])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $softDelete = $this->lessonsRepository->softDelete($id);

        if ($softDelete) {
            return redirect()
                ->route('admin.lessons.index')
                ->with(['success' => 'Успешно удалина']);
        }
    }
}
