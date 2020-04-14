<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Lessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $journals = \DB::table('lessons')
//            ->join('groups', 'lessons.group_id', '=', 'groups.id')
//            ->join('users', 'users.group_id', '=', 'groups.id')
//            ->join('subjects', 'lessons.subject_id', '=', 'subjects.id')
//            ->leftJoin('journals', function ($join) {
//                $join->on('lessons.id', '=', 'journals.lesson_id');
//                $join->on('journals.student_id', '=', 'users.id');
//            })
//            ->select(\DB::raw('DATE_FORMAT(FROM_UNIXTIME(lessons.date_event), "%Y-%m-%d %h:%i:%s") as date'),
//                'subjects.name as subject', 'groups.name as group', 'users.name as studentName', 'users.surname as studentSurname',
//                'journals.exist', 'journals.mark')
//            ->where('lessons.group_id', '=', '1')
//            ->where('lessons.subject_id', '=', '2')
//            ->get();

        $lessons = Lessons::with('groups', 'subjects')->where([['group_id', 1],['subject_id',2]])->get();


//        $journal = [];
//        foreach ($journals as $row) {
//            $journal[$row->subject][$row->date][$row->group][$row->studentSurname] = $row->mark;
//        }
       dd($lessons);
//        dd($journal);
//
        return view('front.journals.index', compact( 'lessons'));
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
