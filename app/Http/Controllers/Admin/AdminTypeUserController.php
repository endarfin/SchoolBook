<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Requests\TypeUserRequest;

class AdminTypeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types= Type::all();
        return view('admin.users.types.index', compact('types'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeUserRequest $request)
    {
        $data = $request->input();
        $type = (new Type())->create($data);

        if ($type) {
            return redirect()
                ->route('admin.types.create')
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
     * @param  \App\Models\Type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
       if (!$type) { abort (404); }

        return view('admin.users.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function update(TypeUserRequest $request, Type $type)
    {
        if (empty($type)) {
            return back()
                ->withErrors(['msg' => "Запись id = [$type->id] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $type->update($data);

        if ($result) {
            return redirect()
                ->route('admin.types.edit', $type->id)
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
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        /** @var TYPE_NAME $type */
        $type->delete();

        if ($type) {
            return redirect()
                ->route('admin.types.index')
                ->with(['success' => 'Успешно удалено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения']);

        }
    }
}
