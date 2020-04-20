<?php

namespace App\Repositories;

use App\Models\teacherSubject as Model;
/**
 * Class teacherSubjectRepository
 * @package App\Repositories
 */
class teacherSubjectRepository extends CoreRepository
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
        $result = $this->startConditions()
            ->where('subject_id', $id)
            ->with('User:id,name,surname')
            ->get();
        return  $result;
    }
    public function find($date)
    {
        return $this->startConditions()
            ->where([['user_id', $date->user_id], ['subject_id', $date->subject_id]])
            ->exists();
    }

}
