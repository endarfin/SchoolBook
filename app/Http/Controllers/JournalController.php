<?php

namespace App\Http\Controllers;

use App\Models\Journal;
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
        $journals = \DB::table('journals')
            ->join('lessons', 'journals.lesson_id','=','lessons.id')
            ->join('users as a','journals.student_id', '=', 'a.id')
            ->join('users as b', 'lessons.group_id', '=', 'b.id')
            ->join('subjects', 'lessons.subject_id', '=', 'subjects.id')
            ->select('journals.id', DB::raw('DATE_FORMAT(FROM_UNIXTIME(lessons.date_event), "%Y-%m-%d %h:%i:%s") as date'), 'journals.mark', 'a.name as NameStudent', 'b.name as NameGroup', 'subjects.name as subjects')
            ->orderBy('subjects', 'asc')
            ->orderBy('lessons.date_event')
            ->get();
//        dd($journals);
        return view('front.journals.index', compact('journals'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function show(Journal $journal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function edit(Journal $journal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journal $journal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal)
    {
        //
    }
}
