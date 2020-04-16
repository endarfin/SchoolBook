<?php

namespace App\Repositories;

use App\Models\Subject as Model;
/**
 * Class SubjectRepository
 * @package App\Repositories
 */
class SubjectRepository extends CoreRepository
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

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }


    /**
     * Получить категории для вывода пагинатором
     */

    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'name'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);
        return $result;
    }

    public function itemDelete($id)
    {
        $result = $this->startConditions()
            ->find($id)
            ->Delete();

        return $result;
    }

    public function getForComboBox()
    {
        $columns = ['id', 'name'];

        $result = $this->startConditions()
            ->select($columns)
            ->toBase()
            ->get();

        return $result;
    }
}
