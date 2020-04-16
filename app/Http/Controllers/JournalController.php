<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Journal;
use App\Models\Lessons;
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
    public function index()
    {
        $students = \DB::table('users')
            ->select('name', 'surname', 'login')
            ->where('group_id','=','1')
            ->get();

        $date = \DB::table('lessons')
            ->select('lessons.date_event as date')
            ->where([['group_id','=','1'],['subject_id','=','2']])
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
            ->where([['lessons.group_id', '=', '1'],['lessons.subject_id', '=', '2']])
            ->get();

        foreach ($marks as $mark) {
            $schedule[$mark->user][$mark->date]= $mark->mark;
        }
        foreach ($date as $date) {
            $day[] = $date->date;
        }
        $days = count($day);

        foreach ($students as $student) {
            $user[$student->login]= $student->surname.' '.$student->name;
        }

//        dd($abc);

        return view('front.journals.index', compact( 'user', 'date', 'schedule', 'day', 'days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function show(Journal $journal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function edit(Journal $journal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journal $journal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal)
    {
        //
    }
}
