<?php
namespace App\Repositories;

use App\Models\Sliders as Model;
use Intervention\Image\Facades\Image as ImageInt;

/**
 * Class SlidersRepository
 * @package App\Repositories
 */
class SlidersRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function save ($request)
    {
        foreach ($request->file('image') as $file){
            $filename = time() . $file->getClientOriginalName();
            $img = ImageInt::make($file)->resize(1127,  251)->save('img/sliders/' . $filename);;
            $paths['url'] = 'img/sliders/'. $filename;
            $result = $this->startConditions()
                ->create($paths);
        }

        return $result;
    }

    public function getAllWithPaginate($perPage)
    {
        $columns = ['id', 'url', 'is_published'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);
        return $result;
    }

    public function getAllWithIsPublished()
    {
        $columns = ['id', 'url'];
        $result = $this
            ->startConditions()
            ->where('is_published', 1)
            ->select($columns)
            ->get();

        return $result;
    }

    public function getAllWithNotPublished()
    {
        $columns = ['id', 'url'];
        $result = $this
            ->startConditions()
            ->where('is_published', '0')
            ->select($columns)
            ->get();

        return $result;
    }

    public function getEdit($id)
    {
        $result = $this->startConditions()->find($id);

        return $result;
    }
    public function changePublished($edit, $request)
    {
        if ($request->change == 1){
            $result = $edit
                ->fill(['is_published' => '0'])
                ->save();
        }else{
            $result = $edit
                ->fill(['is_published' => '1'])
                ->save();
        }

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
