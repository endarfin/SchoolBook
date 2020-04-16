<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Repositories\NewsCategoriesRepository;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    private $newsRepository;
    private $newsCategoriesRepository;

    public function __construct()
    {
        $this->newsRepository = app(NewsRepository::class);
        $this->newsCategoriesRepository = app(NewsCategoriesRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNews = $this->newsRepository->getAllWithPaginate(15);
        //dd($allNews);
        return view('admin.news.news', compact('allNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories = $this->newsCategoriesRepository->getAll();
        //dd($allCategories);
        return view('admin.news.createNews', compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        //dd(__METHOD__, $request);
        $news = $request;
        $result = $this->newsRepository->newsCreated($news);

        if ($result) {
            return redirect()
                ->route('admin.news.edit', $result->id)
                ->with(['success' => 'Успешно создано']);
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
        $allCategories = $this->newsCategoriesRepository->getAll();
        $edit = $this->newsRepository->getEdit($id);
        //dd($allCategories, $edit);
        return view('admin.news.editNews', compact('allCategories', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $ed_news = $this->newsRepository->getEdit($id);
        if (empty($ed_news)) {
            return back()
                ->withErrors(['msg' => "Запись id={$id} не найдена"])
                ->withInput();
        }
        $result = $this->newsRepository->upDate($ed_news, $request);

        //dd(__METHOD__, $request, $ed_news, $result);
        if ($result) {
            return redirect()
                ->route('admin.news.edit', $ed_news->id)
                ->with(['success' => 'Успешно измененно']);
        } else {
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
        $softDelete = $this->newsRepository->softDelete($id);

        if ($softDelete) {
            return redirect()
                ->route('admin.news.index')
                ->with(['success' => 'Успешно удалина']);
        }
    }
}
