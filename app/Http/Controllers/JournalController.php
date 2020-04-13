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
        $journals = \DB::table('lessons')
            ->join('groups', 'lessons.group_id', '=', 'groups.id')
            ->join('users', 'users.group_id', '=', 'groups.id')
            ->leftJoin('journals', function ($join){
                $join->on('lessons.id', '=', 'journals.lesson_id');
                $join->on('journals.student_id', '=', 'users.id');
            })
            ->select(\DB::raw('DATE_FORMAT(FROM_UNIXTIME(lessons.date_event), "%Y-%m-%d %h:%i:%s") as date'), 'groups.name as group', 'users.name as studentName', 'users.surname as studentSurename', 'journals.mark')
            ->where('lessons.id', '=' ,'1')
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
