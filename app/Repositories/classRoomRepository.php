<?php
namespace App\Repositories;

use App\Models\ClassRooms as Model;

/**
 * Class CoursesRepository
 * @package App\Repositories
 */
class classRoomRepository extends CoreRepository
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
}
