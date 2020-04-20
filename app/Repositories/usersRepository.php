<?php
namespace App\Repositories;

use App\Models\User as Model;

/**
 * Class usersRepository
 * @package App\Repositories
 */
class  usersRepository extends CoreRepository
{


    public function getTeacherForComboBox()
    {
        $columns = ['id', 'surname'];

        $result = $this->startConditions()
            ->select($columns)
            ->where('type_user_id', '2')
            ->with('subjects')
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

    public function find($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllTeacher()
    {
        $columns = ['id', 'surname', 'name'];

        $result = $this->startConditions()
            ->select($columns)
            ->where('type_user_id','2')
            ->get();

        return $result;

    }

    public function getStudents($group_id)
    {
        $columns = ['login', 'surname', 'name'];

        $result = \DB::table('users')
            ->select($columns)
            ->where('group_id', '=', $group_id)
            ->get();

        return $result;

    }


}
