<?php

namespace App\Repositories;

use App\Models\NewsCategories as Model;
/**
 * Class NewsCategoriesRepository
 * @package App\Repositories
 */
class NewsCategoriesRepository extends CoreRepository
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

    public function getAll()
    {
        $columns = ['id','name'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->toBase()
            ->get();

        return $result;
    }

}
