<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderDownloadRequest;
use App\Http\Requests\SliderUploadedRequest;
use App\Repositories\SlidersRepository;

class AdminSliderController extends Controller
{
    private $slidersRepository;

    public function __construct()
    {
        $this->slidersRepository = app(slidersRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $isPublished = $this->slidersRepository->getAllWithIsPublished();
        //dd($all, $isPublished);
        return view('admin.slider.slider', compact('isPublished'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(SliderDownloadRequest $request)
    {

        $result = $this->slidersRepository->save($request);

        if ($result) {
            return redirect()
                ->route('admin.slider.index')
                ->with(['success' => 'Успешно загружено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка соханения'])
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
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(__METHOD__);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUploadedRequest $request, $id)
    {
        $edit = $this->slidersRepository->getEdit($id);
        if (empty($edit)) {
            return response()->json([
                            'status' => 'false',
                            'msg' => 'Изображение не найдено']);
        }
        $result = $this->slidersRepository->changePublished($edit, $request);

        if ($result){
            return response()->json([
                'status' => 'true',
                'msg' => $request->change]);
        }else{
            return response()->json([
                'status' => 'false',
                'msg' => 'Что-то пошло нет так']);
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
        $result = $this->slidersRepository->softDelete($id);

        if ($result) {
            return response()->json([
                'status' => 'true',
                'msg' => 'Удалено',
            ]);
        }else{
            return response()->json([
                'status' => 'false',
                'msg' => 'Что-то пошло не так',
            ]);
        }

    }
}
