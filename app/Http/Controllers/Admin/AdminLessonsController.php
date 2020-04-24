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
        $classRooms = $this->classRoomRepository->getForComboBox();
        $timeLessons = $this->timeLessonsRepository->getAll();
        return view('admin.lessons.createLessons', compact('groups','classRooms', 'timeLessons'));

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
                if ($exist){
                    if ($freeTeacherTime){
                        if ($freeGroupTime){
                            if ($freeClassRoomTime){
                                $result = $this->lessonsRepository->lessonCreated($lessons);
                                }else{return response()->json([
                                        'status' => 'false',
                                        'msg' => 'Кабинет в это времязанят']);}
                            }else{return response()->json([
                                        'status' => 'false',
                                        'msg' => 'У группы уже запланирован урок в это время']);}
                        }else{return response()->json([
                                    'status' => 'false',
                                    'msg' => 'У преподавателя уже запланирован урок в это время']);}
                }else{return response()->json([
                            'status' => 'false',
                            'msg' => 'Такой урок уже есть']);}
                }else{return response()->json([
                        'status' => 'false',
                        'msg' => 'Преподаватель не проподает такой придмет']);}
            }else{ return response()->json([
                    'status' => 'false',
                    'msg' => 'У группы нет такого предмета']);}

        if ($result) {
            return response()->json([
                'status' => 'true',
                'msg' => 'Успешно создано']);
        } else {
            return response()->json([
                'status' => 'false',
                'msg' => 'Ошибка соханения']);
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
        $subjects = $this->groupsRepository->getGroupsWhere($lesson->group_id);
        $groups = $this->groupsRepository->getForComboBox();
        $teachers = $this->teacherSubjectRepository->getAllWhere($lesson->subject_id);
        $classRooms = $this->classRoomRepository->getForComboBox();
        $timeLessons = $this->timeLessonsRepository->getAll();
        return view('admin.lessons.editLessons', compact('lesson','groups', 'subjects', 'teachers', 'classRooms', 'timeLessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, LessonsRequest $request)
    {
        $ed_lesson = $this->lessonsRepository->getEdit($id);
        if (empty($ed_lesson)) {
            return back()
                ->withErrors(['msg' => "Запись id={$id} не найдена"])
                ->withInput();
        }
        //dd($ed_lesson, $request);
        $groupSubjects = true;
        $teacherSubject = true;
        $freeTeacherTime = true;
        $freeGroupTime = true;
        $freeClassRoomTime = true;

        if ($ed_lesson->subject_id != $request->subject_id){
            $groupSubjects = $this->groupSubjectRepository->find($request);
            $teacherSubject = $this->teacherSubjectRepository->find($request);
        }
        if ($ed_lesson->group_id != $request->group_id){
            $freeGroupTime = $this->lessonsRepository->freeGroupTime($request);
            $teacherSubject = $this->teacherSubjectRepository->find($request);
            $groupSubjects = $this->groupSubjectRepository->find($request);
        }

        if ($ed_lesson->user_id != $request->user_id){
            $freeTeacherTime = $this->lessonsRepository->freeTeacherTime($request);
            $teacherSubject = $this->teacherSubjectRepository->find($request);
        }

        if ($ed_lesson->class_room_id != $request->class_room_id){
            $freeClassRoomTime = $this->lessonsRepository->freeClassRoomTime($request);
        }
        if ($ed_lesson->lesson != $request->lesson){
            $freeGroupTime = $this->lessonsRepository->freeGroupTime($request);
            $freeTeacherTime = $this->lessonsRepository->freeTeacherTime($request);
            $freeClassRoomTime = $this->lessonsRepository->freeClassRoomTime($request);
        }



       $exist = $this->lessonsRepository->exist($request);

        $result = false;
        if ($groupSubjects) {
            if ($teacherSubject){
                if ($exist){
                    if ($freeTeacherTime  ){
                        if ($freeGroupTime){
                            if ($freeClassRoomTime){
                                $result = $this->lessonsRepository->upDate($ed_lesson, $request);
                            }else{return response()->json([
                                'status' => 'false',
                                'msg' => 'Кабинет в это время занят']);}
                        }else{return response()->json([
                            'status' => 'false',
                            'msg' => 'У группы уже запланирован урок в это время']);}
                    }else{return response()->json([
                        'status' => 'false',
                        'msg' => 'У преподавателя уже запланирован урок в это время']);}
                }else{return response()->json([
                    'status' => 'false',
                    'msg' => 'Такой урок уже есть']);}
            }else{return response()->json([
                'status' => 'false',
                'msg' => 'Преподаватель не преподает такой придмет']);}
        }else{ return response()->json([
            'status' => 'false',
            'msg' => 'У группы нет такого предмета']);}


        if ($result) {
            return response()->json([
                'status' => 'true',
                'msg' => 'Успешно изменено']);
        } else {
            return response()->json([
                'status' => 'false',
                'msg' => 'Ошибка сохранения']);
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
                ->with(['success' => 'Успешно удалена']);
        }
    }
}
