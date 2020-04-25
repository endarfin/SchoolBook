<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use App\Repositories\SubjectRepository;
use App\Repositories\GroupsRepository;
use App\Repositories\usersRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\TimeLessonsRepository;
use DateTime;
use Gate;
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
//        if (!\Gate::allows('isAdmin') || !\Gate::allows('isTeacher')){
//            abort(403,"Извините, у Вас нет прав на єто действие! Вернитесь назад.");
//        }
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
}
