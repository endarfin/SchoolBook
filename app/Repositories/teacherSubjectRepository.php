<?php

namespace App\Repositories;

use App\Models\teacherSubject as Model;
/**
 * Class SubjectRepository.
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
        return $this->startConditions()
            ->select('user_id', 'subject_id')
            ->where('user_id', $id)
            ->toBase()
            ->get();
    }

}
