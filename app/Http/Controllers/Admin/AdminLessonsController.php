<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLessonsRequest;
use App\Repositories\classRoomRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\groupSubjectRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\subjectRepository;
use App\Repositories\teacherSubjectRepository;
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

    public function __construct()
    {
        $this->groupsRepository = app(GroupsRepository::class);
        $this->lessonsRepository = app(LessonsRepository::class);
        $this->subjectRepository = app(subjectRepository::class);
        $this->usersRepository = app(usersRepository::class);
        $this->classRoomRepository = app(classRoomRepository::class);
        $this->groupSubjectRepository = app(groupSubjectRepository::class);
        $this->teacherSubjectRepository = app(teacherSubjectRepository::class);
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
        $subjects = $this->subjectRepository->getForComboBox();
        $teachers = $this->usersRepository->getForComboBox();
        $classRooms = $this->classRoomRepository->getForComboBox();
        return view('admin.lessons.createLessons', compact('groups', 'subjects', 'teachers', 'classRooms'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminLessonsRequest $request)
    {
        $lessons = $request;

        $groupSubjects = $this->groupSubjectRepository->getAllWhere($lessons->group_id);

        $teacherSubject = $this->teacherSubjectRepository->getAllWhere($lessons->user_id);

        $result = false;

        foreach ($groupSubjects as $groupSubject) {
            foreach ($teacherSubject as $Subject) {
                if ($lessons->subject_id == $groupSubject->subject_id) {
                    if ($Subject->subject_id == $lessons->subject_id){
                        $result = $this->lessonsRepository->lessonCreated($request);
                    }
                }
            }
        }
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
        $lesson = $this->lessonsRepository->GetEdit($id);
        $groups = $this->groupsRepository->getForComboBox();
        $subjects = $this->subjectRepository->getForComboBox();
        $teachers = $this->usersRepository->getForComboBox();
        $classRooms = $this->classRoomRepository->getForComboBox();
        return view('admin.lessons.editLessons', compact('lesson', 'groups', 'subjects', 'teachers', 'classRooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminLessonsRequest $request, $id)
    {
        $ed_lesson = $this->lessonsRepository->getEdit($id);
        $ed_request = $request;
        if (empty($ed_lesson)) {
            return back()
                ->withErrors(['msg' => "Запись id={$id} не найдена"])
                ->withInput();
        }
        $groupSubjects = $this->groupSubjectRepository->getAllWhere($ed_request->group_id);
        $teacherSubjects = $this->teacherSubjectRepository->getAllWhere($ed_request->user_id);

        $result = false;
        foreach ($groupSubjects as $groupSubject) {
            foreach ($teacherSubjects as $teacherSubject) {
                if ($ed_request->subject_id == $groupSubject->subject_id)
                    if ($teacherSubject->subject_id == $ed_request->subject_id)
                        $result = $this->lessonsRepository->upDate($ed_lesson, $request);
            }
        }


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
