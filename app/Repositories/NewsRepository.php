<?php

namespace App\Repositories;

use App\Models\News as Model;
use Illuminate\Support\Str;

/**
 * Class NewsRepository
 * @package App\Repositories
 */
class NewsRepository extends CoreRepository
{
    /**
     * @return string
     *  Return the model
     * Получить модель для редактирования
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate($perPage)
    {
        $columns = ['id', 'categories_id', 'user_id', 'is_published', 'title', 'img'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(['author:id,name,surname', 'categories:id,name'])
            ->paginate($perPage);


        return $result;
    }
    public function getAllWithPaginateIndex($perPage)
    {
        $columns = ['categories_id', 'user_id', 'title', 'img', 'excerpt', 'published_ad', 'slug'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('is_published','1')
            ->orderBy('id', 'DESC')
            ->with(['author:id,name,surname', 'categories:id,name'])
            ->paginate($perPage);


        return $result;
    }
    public function newsCreated($request)
    {
        $news = $request;
        if (empty($news['slug'])){
            $news['slug'] = str::slug($news['title']);
        }
        if (!empty($news->file('img'))){
            $pant = $news->file('img')->store('uploads', 'newsImg');
            $news['img'] = $pant;
        }
        $news = $request->input();
        //dd($news, $news['slug'], $pant, is_null($news->file('img')));
        $result = $this->startConditions()
            ->create($news);
        return $result;

    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function findNews($slug)
    {
        $columns = ['categories_id', 'user_id', 'title', 'img', 'content'];

        $result = $this->startConditions()
            ->select($columns)
            ->where('slug', $slug)
            ->with('author:id,name,surname')
            ->first();

        return $result;
    }

    public function bracingNews()
    {
        $columns = ['categories_id', 'user_id', 'title', 'img', 'excerpt', 'published_ad', 'slug'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('is_published','1')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        return $result;
    }

    public function upDate($ed_lesson, $request)
    {
        $news = $request;
        //dd($date);
        if (empty($news['slug'])){
            $news['slug'] = str::slug($news['title']);
        }
        if (!empty($news->file('img'))){
            $pant = $news->file('img')->store('uploads', 'newsImg');
            $news['img'] = $pant;
        }
        if ($news['is_published'] == 1){
            $news['published_ad'] = date('Y-m-d H:i:s', time());
        }
        $news = $request->input();
        $result = $ed_lesson
            ->fill($news)
            ->save();
        return $result;
    }
    public function softDelete($id)
    {
        $result = $this->startConditions()
            ->find($id)
            ->Delete();

        return $result;
    }

}
