<?php
namespace App\Repositories;

use App\Models\users as Model;

/**
 * Class CoursesRepository
 * @package App\Repositories
 */
class  usersRepository extends CoreRepository
{


    public function getForComboBox()
    {
        $columns = ['id', 'surname'];

        $result = $this->startConditions()
            ->select($columns)
            ->where('type_user_id','2')
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
