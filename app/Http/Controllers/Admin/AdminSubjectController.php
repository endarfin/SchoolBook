<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminSubjectCreateRequest;
use App\Http\Requests\AdminSubjectUpdateRequest;
use App\Models\Subject;
use App\Http\Controllers\Controller;

class AdminSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate(5);
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectList = Subject::all();

        return view('admin.subjects.create',
                    compact('subjectList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminSubjectCreateRequest $request)
    {
        $data = $request->input();
        $subject = (new Subject())->create($data);

        if ($subject) {
            return redirect()
                ->route('admin.subjects.create', [$subject->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $subjectList = Subject::all();

        return view('admin.subjects.edit', compact('subject','subjectList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminSubjectUpdateRequest $request, $id)
    {
        $subject = Subject::find($id);
        if (empty($subject)) {
            return back()
                ->withErrors(['msg' => "Запись id = [{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $subject->update($data);

        if ($result) {
            return redirect()
                ->route('admin.subjects.edit', $subject->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
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
        $subject = Subject::find($id);
        if ($subject) {
            return redirect()
                ->route('admin.subjects.index')
                ->with(['success' => 'Успешно удалено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения']);

        }
    }
}
