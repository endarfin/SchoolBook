<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\groupsRequest;
use App\Models\Groups;
use App\Repositories\CoursesRepository;
use App\Repositories\GroupsRepository;

class adminGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $coursesRepository;
    private $groupsRepository;

    public function __construct()
    {
        $this->coursesRepository = app(CoursesRepository::class);
        $this->groupsRepository = app(GroupsRepository::class);
    }

    public function index()
    {
        //$groups = Groups::paginate(9);
        $groups = $this->groupsRepository->getAllWithPaginate(10);
        return view('admin.groups.groups', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = $this->coursesRepository->getForComboBox();
        return view('admin.groups.createGroups', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(groupsRequest $request)
    {
       //dd(__METHOD__, $request->all());
        //$item = (new Groups())->create($group);
        $group = $request->input();
        $result = new Groups($group);
        $result->save();
        if ($result)
        {
            return redirect()
                ->route('admin.groups.edit', $result->id)
                ->with(['success' => 'Успешно создано']);
        }else {
            return back()
                ->withErrors(['msg' => 'Ошибка соханения'])
                ->withInput();
        }
    }

    /**
     * @param $id
     * @param GroupsRepository $groupRepository
     * @param CoursesRepository $coursesRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $group = $this->groupsRepository->getEdit($id);
        if (empty($group)){
            abort(404);
        }
        $courses = $this->coursesRepository->getForComboBox();
        //dd($group, $courses);
       return view('admin.groups.editGroup', compact('group', 'courses'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(groupsRequest $request, $id)
    {
        $ed_group = $this->groupsRepository->getEdit($id);
        if (empty($ed_group))
        {
            return back()
                ->withErrors(['msg' => "Запись id={$id} не найдена"])
                ->withInput();
        }
        $date = $request->all();
        $result = $ed_group
            ->fill($date)
            ->save();
        if ($result)
        {
            return redirect()
                ->route('admin.groups.edit', $ed_group->id)
                ->with(['success' => 'Успешно измененно']);
        }else {
            return back()
                ->withErrors(['msg' => 'Ошибка соханения'])
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
        //dd(__METHOD__, $id);
        $softDelete =  $this->groupsRepository->softDelete($id);

        if ($softDelete)
        {
            return redirect()
                ->route('admin.groups.index')
                ->with(['success' => 'Успешно удалина']);
        }
    }
}
