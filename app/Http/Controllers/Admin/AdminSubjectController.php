<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubjectRequest;
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
        $subjects = Subject::paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $data = $request->input();
        $subject = (new Subject())->create($data);

        if ($subject) {
            return redirect()
                ->route('admin.subjects.create')
                ->with(['success' => 'Успешно добавлено']);
        } else {
            return Redirect::back()->withInput()
                ->withErrors(['msg' => 'Ошибка сохранения']);

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        if (!$subject) { abort (404); }

        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
       if (empty($subject)) {
            return back()
                ->withErrors(['msg' => "Запись id = [$subject->$id] не найдена"])
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
     * @param
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

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
