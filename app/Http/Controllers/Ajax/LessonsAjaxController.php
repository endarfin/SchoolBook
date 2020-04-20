<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\groupSubjectRepository;
use App\Repositories\teacherSubjectRepository;
use Illuminate\Http\Request;

class LessonsAjaxController extends Controller
{
    private $groupSubjectRepository;
    private $teacherSubjectRepository;

    public function __construct()
    {
        $this->groupSubjectRepository = app(groupSubjectRepository::class);
        $this->teacherSubjectRepository = app(teacherSubjectRepository::class);
    }

    public function index()
    {

        return view('hom');
    }

    public function groupSubjects( Request $request)
    {


        $groupSubjects = $this->groupSubjectRepository->getAllWhere($request->id);

        return response()->json([
            'status' => '200',
            'view' => view('admin.ajax.lessons.Subject', compact('groupSubjects'))->render()
        ]);
    }

    public function teachersSubjects( Request $request)
    {


        $teachers = $this->teacherSubjectRepository->getAllWhere($request->id);

        return response()->json([
            'status' => '200',
            'view' => view('admin.ajax.lessons.teachers', compact('teachers'))->render()
        ]);
    }
}
