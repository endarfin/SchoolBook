<?php

namespace App\Repositories;

use App\Models\groupSubject as Model;
/**
 * Class SubjectRepository.
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
            ->toBase()
            ->get();
    }
    public function find($date)
    {
        return $this->startConditions()
            ->select('group_id', 'subject_id')
            ->where('group_id', $date->group_id)
            ->where('subject_id', $date->subject_id)
            ->exists();
    }

}
