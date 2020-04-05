<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;



class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
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

        return view('admin.users.create',
            compact('types','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->input();
        $user = (new User())->create($data);

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
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!$user) { abort (404); }
        $types = Type::all();
        $groups = Groups::all();

        return view('admin.users.edit', compact('user', 'types', 'groups'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if (empty($user)) {
            return back()
                ->withErrors(['msg' => "Запись id = [$user->id] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $user->update($data);

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
        $user->delete();

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
