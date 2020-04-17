<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Journal;
use App\Models\Lessons;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::all();
        $groups = Groups::all();
        if (!empty($request->all())) {
            $group_id = $request->input('group_id');
            $subject_id = $request->input('subject_id');
            $groupName = Groups:: findOrFail($group_id)->name;
            $subjectName = Subject:: findOrFail($subject_id)->name;
//            dd($group);
            $students = \DB::table('users')
                ->select('name', 'surname', 'login')
                ->where('group_id', '=', $group_id)
                ->get();

            $date = \DB::table('lessons')
                ->select('lessons.date_event as date')
                ->where([['group_id', '=', $group_id], ['subject_id', '=', $subject_id]])
                ->get();

            $marks = \DB::table('lessons')
                ->join('groups', 'lessons.group_id', '=', 'groups.id')
                ->join('users', 'users.group_id', '=', 'groups.id')
                ->join('subjects', 'lessons.subject_id', '=', 'subjects.id')
                ->leftJoin('journals', function ($join) {
                    $join->on('lessons.id', '=', 'journals.lessons_id');
                    $join->on('journals.student_id', '=', 'users.id');
                })
                ->select('lessons.date_event as date', 'users.login as user', 'journals.mark as mark')
                ->where([['lessons.group_id', '=', $group_id], ['lessons.subject_id', '=', $subject_id]])
                ->get();

            foreach ($marks as $mark) {
                $schedule[$mark->user][$mark->date] = $mark->mark;
            }
            foreach ($date as $date) {
                $day[] = $date->date;
            }

            if (empty($day)) {
                return back()
                    ->withErrors(['msg' => "В расписании для группы \"$groupName\" предмет \"$subjectName\" не найден"]);

            }
                $days = count($day);
                foreach ($students as $student) {
                    $user[$student->login] = $student->surname . ' ' . $student->name;
                }

                return view('front.journals.index', compact('groups', 'subjects', 'groupName', 'subjectName', 'user', 'date', 'schedule', 'day', 'days'));

        } else {
            return view('front.journals.index', compact('groups', 'subjects'));
        }
    }
}
