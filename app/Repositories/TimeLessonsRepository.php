<?php

namespace App\Repositories;

use App\Models\TimeLessons as Model;

/**
 * Class CoursesRepository
 * @package App\Repositories
 */
class  TimeLessonsRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $columns = ['id', 'number', 'time'];

        $result = $this->startConditions()
            ->select($columns)
            ->get();

        return $result;

    }
}
