<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLessonsRequest;
use App\Repositories\classRoomRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\subjectRepository;
use App\Repositories\usersRepository;


class AdminLessonsController extends Controller
{

    private $groupsRepository;
    private $lessonsRepository;
    private $subjectRepository;
    private $usersRepository;
    private $classRoomRepository;

    public function __construct()
    {
        $this->groupsRepository = app(GroupsRepository::class);
        $this->lessonsRepository = app(LessonsRepository::class);
        $this->subjectRepository = app(subjectRepository::class);
        $this->usersRepository = app(usersRepository::class);
        $this->classRoomRepository = app(classRoomRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons =  $this->lessonsRepository->getAllWithPaginate(10);
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
        $groups =  $this->groupsRepository->getForComboBox();
        $subjects =  $this->subjectRepository->getForComboBox();
        $teachers =  $this->usersRepository->getForComboBox();
        $classRooms =  $this->classRoomRepository->getForComboBox();
        //dd(__METHOD__, $lesson, $groups, $subjects, $teachers, $classRooms  );
        return view('admin.lessons.createLessons', compact( 'groups', 'subjects', 'teachers', 'classRooms'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminLessonsRequest $request)
    {
        //dd(__METHOD__, $request);
        $result = $this->lessonsRepository->lessonCreated($request);
        if ($result)
        {
            return redirect()
                ->route('admin.lessons.edit', $result->id)
                ->with(['success' => 'Успешно создано']);
        }else {
            return back()
                ->withErrors(['msg' => 'Ошибка соханения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson =  $this->lessonsRepository->GetEdit($id);
        $groups =  $this->groupsRepository->getForComboBox();
        $subjects =  $this->subjectRepository->getForComboBox();
        $teachers =  $this->usersRepository->getForComboBox();
        $classRooms =  $this->classRoomRepository->getForComboBox();
        //dd(__METHOD__, $lesson, $groups, $subjects, $teachers, $classRooms  );
        return view('admin.lessons.editLessons', compact('lesson', 'groups', 'subjects', 'teachers', 'classRooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminLessonsRequest $request, $id)
    {
        $ed_lesson = $this->lessonsRepository->getEdit($id);
        if (empty($ed_lesson))
        {
            return back()
                ->withErrors(['msg' => "Запись id={$id} не найдена"])
                ->withInput();
        }else{
            $request['date_event'] = strtotime($request['date_event']);
        }

        $result = $this->lessonsRepository->upDate($ed_lesson, $request);
//        $date = $request->input();
//        $result = $ed_lesson
//            ->fill($date)
//            ->save();
//        dd(__METHOD__, $id, $date);

        if ($result)
        {
            return redirect()
                ->route('admin.lessons.edit', $ed_lesson->id)
                ->with(['success' => 'Успешно измененно']);
        }else {
            return back()
                ->withErrors(['msg' => 'Ошибка соханения'])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $softDelete = $this->lessonsRepository->softDelete($id);

        if ($softDelete)
        {
            return redirect()
                ->route('admin.groups.index')
                ->with(['success' => 'Успешно удалина']);
        }
    }
}
