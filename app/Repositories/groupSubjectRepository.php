<?php

namespace App\Repositories;

use App\Models\groupSubject as Model;
/**
 * Class groupSubjectRepository
 * @package App\Repositories
 */

class groupSubjectRepository extends CoreRepository
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

    public function getAllWhere($id)
    {
        return $this->startConditions()
            ->select('group_id', 'subject_id')
            ->where('group_id', $id)
            ->with('Subject:id,name')
            ->get();
    }
    public function find($date)
    {
        return $this->startConditions()
            ->select('group_id', 'subject_id')
            ->where([['group_id', $date->group_id], ['subject_id', $date->subject_id]])
            ->exists();
    }

}
