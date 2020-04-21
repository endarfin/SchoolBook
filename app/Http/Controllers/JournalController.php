<?php

namespace App\Http\Controllers;
use App\Models\Journal;
use Illuminate\Http\Request;
use App\Repositories\SubjectRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\usersRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\TimeLessonsRepository;
use DateTime;
class JournalController extends Controller
{
    private $subjectRepository;
    private $groupsRepository;
    private $usersRepository;
    private $TimeLessonsRepository;

    public function __construct()
    {
        $this->subjectRepository = app(subjectRepository::class);
        $this->groupsRepository = app(GroupsRepository::class);
        $this->usersRepository = app(usersRepository::class);
        $this->LessonsRepository = app(LessonsRepository::class);
        $this->TimeLessonsRepository = app(TimeLessonsRepository::class);
    }

    public function index(Request $request)
    {
        $groups = $this->groupsRepository->getForComboBox();
        $subjects = $this->subjectRepository->getForComboBox();

            $group_id = $request->get('group_id');
            $subject_id = $request->get('subject_id');
            $periodBegin = $request->get('periodBegin');
            $periodEnd = $request->get('periodEnd');

        if (($group_id)&&($subject_id)) {

            $students = $this->usersRepository->getStudents($group_id);
            $dates = $this->LessonsRepository->getPeriod($group_id, $subject_id, $periodBegin, $periodEnd);
            $marks = $this->LessonsRepository->getStudentsDateMarks($group_id, $subject_id, $periodBegin, $periodEnd);
            $lessons = $this->TimeLessonsRepository->getAll();

            foreach ($marks as $mark) {
                $schedule[$mark->user][$mark->date][$mark->lesson] = $mark->mark;
            }

            foreach ($lessons as $lesson) {
                $period[] = $lesson->number;
            }

            if (empty($schedule)) {
                return back()
                    ->withErrors(['msg' => "The subject was not found in the journal for this group"]);
            }
            $days = count($dates);

            foreach ($students as $student) {
                $users[$student->login] = $student->surname . ' ' . $student->name;
            }
            return view('front.journals.index', compact('groups','subjects', 'periodBegin', 'periodEnd','group_id', 'subject_id', 'users', 'schedule', 'dates', 'period'));

        } else {
            return view('front.journals.index', compact('groups', 'subjects'));
        }
    }

    public function post(Request $request) {

        $group_id = $request->get('group_id');
        $subject_id = $request->get('subject_id');

        $periodBegin = new DateTime($request->get('periodBegin'));
        $periodEnd = new DateTime($request->get('periodEnd'));

        switch(request('submit_key')) {
            case 'forward':
                $periodBegin = $periodBegin->modify('+7 day')->format('Y-m-d');
                $periodEnd = $periodEnd->modify('+7 day')->format('Y-m-d');
                break;
            case 'back':
                $periodBegin = $periodBegin->modify('-7 day')->format('Y-m-d');
                $periodEnd = $periodEnd->modify('-7 day')->format('Y-m-d');
                break;
        }
        return redirect()
            ->route('front.journals.index',compact( 'group_id', 'subject_id', 'periodBegin', 'periodEnd' ));
    }

    public function showCurrentLesson(Request $request) {
        $groups = $this->groupsRepository->getForComboBox();
        $subjects = $this->subjectRepository->getForComboBox();
        $lessons = $this->TimeLessonsRepository->getAll();
        $group_id = $request->get('group_id');
        $subject_id = $request->get('subject_id');
        $number = $request->get('number');
        $date = date('y-m-d');

        if ($request) {
            $lesson_id = $this->LessonsRepository->getLessonId($request, $date);
            $students = $this->usersRepository->getStudentsForJournal($request);


        }
            return view('front.lesson.index', compact('groups', 'subjects', 'group_id', 'subject_id', 'number', 'date', 'lessons', 'lesson_id', 'students'));

    }

    public function save(Request $request)
    {
        $arr = $request->input('data');

        foreach ($arr as $param => $arrayValue) {
            for ($i=0;$i<count($arr);$i++) {
                $arr1[$i][$param] = $arrayValue[$i];
            }

        }
        dd($arr1);


        dd($arr);
//
//        dd($data);



        $journal = (new Journal())->create($arr);

        if ($journal) {
            return redirect()
                ->route('showCurrentLesson')
                ->with(['success' => 'Успешно добавлено']);
        } else {
            return Redirect::back()->withInput()
                ->withErrors(['msg' => 'Ошибка сохранения']);

        }

    }

}
