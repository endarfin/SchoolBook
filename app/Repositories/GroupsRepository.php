<?php
namespace App\Repositories;

use App\Models\Groups as Model;

/**
 * Class GroupsRepository
 * @package App\Repositories
 */
class GroupsRepository extends CoreRepository
{
    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllWithPaginate($perPage)
    {
        $columns = ['id', 'name', 'course_id'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->with(['courses:id,name'])
            ->paginate($perPage);
        return $result;
    }
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function softDelete($id)
    {
        $result = $this->startConditions()
            ->find($id)
            ->Delete();

        return $result;
    }
}

