<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeUser;
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
        $typeUser= TypeUser::all();
        return view('admin.users.types.index', compact('typeUser'));

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
        $typeUser = (new TypeUser())->create($data);

        if ($typeUser) {
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
     * @param  \App\Models\TypeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeUser $typeUser)
    {
        if (!$typeUser) { abort (404); }

        return view('admin.users.types.edit', compact('typeUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeUser $typeUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeUser $typeUser)
    {
        //
    }
}
