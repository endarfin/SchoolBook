<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Journal;
use App\Repositories\SubjectRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\usersRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\TimeLessonsRepository;
use App\Repositories\journalsRepository;
use Illuminate\Validation\Rule;


class CurrentLessonController extends Controller
{
    private $subjectRepository;
    private $groupsRepository;
    private $usersRepository;
    private $TimeLessonsRepository;
    private $journalsRepository;
    private $LessonsRepository;

    public function __construct()
    {
        $this->subjectRepository = app(subjectRepository::class);
        $this->groupsRepository = app(GroupsRepository::class);
        $this->usersRepository = app(usersRepository::class);
        $this->LessonsRepository = app(LessonsRepository::class);
        $this->TimeLessonsRepository = app(TimeLessonsRepository::class);
        $this->journalsRepository = app(journalsRepository::class);
    }

    public function showCurrentLesson(Request $request)
    {
        $groups = $this->groupsRepository->getForComboBox();
        $subjects = $this->subjectRepository->getForComboBox();
        $lessons = $this->TimeLessonsRepository->getAll();
        $date =  date('Y-m-d',(time()+3*60*60));

        $group_id = $request->get('group_id');
        $subject_id = $request->get('subject_id');
        $number = $request->get('number');

        $lessons_id = $this->LessonsRepository->getLessonId($request, $date);
        $students = $this->usersRepository->getStudentsForJournal($request);

        if (empty($lessons_id) && ($group_id) && ($subject_id) && ($number)) {
            return back()
                ->withErrors(['msg' => "Journal not found. Please check your choice"])
                ->withInput();
        }

        return view('front.lesson.index', compact('groups', 'subjects', 'group_id', 'subject_id', 'number', 'date', 'lessons', 'lessons_id', 'students'));

    }

    public function saveCurrentLesson(Request $request)
    {
        $arr = $request->input('data');
        foreach ($arr as $param => $arrayValue) {
            for ($i = 0; $i < count($arr['student_id']); $i++) {
                $arr1[$i][$param] = $arrayValue[$i];
            }
        }

        for ($i = 0; $i < count($arr1); $i++) {
            $class = $arr1[$i];
            $existClass = $this->journalsRepository->getExist($class);
            if (!$existClass) {
                $journal = (new Journal())->create($arr1[$i]);
            } else {
                $student = $this->usersRepository->find($class['student_id']);
                return back()
                    ->withErrors(['msg' => "The journal record (about student - $student->name $student->surname) in this lesson is already present"])
                    ->withInput();
            }
        }

        if ($journal) {
            return redirect()
                ->route('showJournal')
                ->with(['success' => 'Successfully added']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }
    public function editCurrentLesson($lesson_id) {

        $lesson = $this->LessonsRepository->getEdit($lesson_id);
        $journals = $this->journalsRepository->getEdit($lesson_id);

        if ($journals->isEmpty()) {
            return back()
                ->withErrors(['msg' => 'The journal has not a record about this lesson. Start lesson please.']);
        } else {
            return view('front.lesson.edit', compact('journals', 'lesson'));
        }

    }
    public function updateCurrentLesson(Request $request) {

//dd($request);

        $arr = $request->input('data');
        foreach ($arr as $param => $arrayValue) {
            for ($i = 0; $i < count($arr['student_id']); $i++) {
                $arr1[$i][$param] = $arrayValue[$i];
            }
        }
        for ($i = 0; $i < count($arr1); $i++) {
                $journal = Journal::where('id', $arr1[$i]['id'])->first();
                $journal->fill($arr1[$i])->save();
        }

        if ($journal) {
            return redirect()
                ->route('showJournal')
                ->with(['success' => 'Successfully added']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }

}

