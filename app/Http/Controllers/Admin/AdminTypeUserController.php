<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeUser;

class AdminTypeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TypeUser = TypeUser::all();
        return view('admin.users.types.index', compact('$TypeUser'));

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
     * @param  \App\Models\TypeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function show(TypeUser $typeUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeUser  $typeUser
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeUser $typeUser)
    {
        dd(1);
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
