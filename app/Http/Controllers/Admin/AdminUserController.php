<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Type;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;



class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(__METHOD__,$request);
        $users = User::when($request->type, function ($query) use ($request) {
            $query->whereHas('type', function ($query) use ($request) {
                $query->whereId($request->type);
            });
        })
            ->paginate(10)->appends(request()->except('page'));
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $groups = Groups::all();
        $subjects = Subject::all()->pluck('name', 'id');
        return view('admin.users.create', compact('types','groups', 'subjects'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        if(!empty($request->subjects[0])) {
            $user->subjects()->sync($request->input('subjects', []));
        }

        if ($user) {
            return redirect()
                ->route('admin.users.create')
                ->with(['success' => 'Успешно добавлено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function show(User $user)
    {
        $user->load('type', 'group', 'subjects');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!$user) { abort (404); }
        $types = Type::all();
        $groups = Groups::all();
        $subjects = Subject::all()->pluck('name', 'id');
        $user->load('type','group','subjects');
        return view('admin.users.edit', compact('types','groups', 'subjects', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (empty($user)) {
            return back()
                ->withErrors(['msg' => "Запись id = [$user->id] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $user->update($data);
        if(!empty($request->subjects[0])) {
            $user->subjects()->sync($request->input('subjects', []));
        }
        if ($result) {
            return redirect()
                ->route('admin.users.edit', $user->id)
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
    public function destroy(User $user)
    {
//        $user->softDelete = 'true';
//            $user->Delete();
        try
        {
            $user->Delete();
        }
        catch(Exception $ex) {
            $user->softDelete = 'true';
            $user->Delete();
        }
        if ($user) {
            return redirect()
                ->route('admin.users.index')
                ->with(['success' => 'Успешно удалено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения']);
        }
    }
}
