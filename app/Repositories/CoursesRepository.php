<?php
namespace App\Repositories;

use App\Models\Courses as Model;

/**
 * Class CoursesRepository
 * @package App\Repositories
 */
class CoursesRepository extends CoreRepository
{


    public function getForComboBox()
    {
        $columns = ['id', 'name'];

        $result = $this->startConditions()
            ->select($columns)
            ->toBase()
            ->get();

        return $result;
    }
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $columns = ['id', 'name'];

        $result = $this->startConditions()
            ->select($columns)
            ->with('groups')
            ->get();

        return $result;

    }
}
