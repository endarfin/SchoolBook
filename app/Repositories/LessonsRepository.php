<?php

namespace App\Repositories;

use App\Models\Lessons as Model;

/**
 * Class GroupsRepository
 * @package App\Repositories
 */
class LessonsRepository extends CoreRepository
{
    /**
     * @param int $id
     * @return Model
     */
    public function checkSame($date)
    {
        //dd($date->group_id);
        return $this->startConditions()
            ->where('group_id', $date->group_id)
            ->where('subject_id', $date->subject_id)
            ->where('user_id', $date->user_id)
            ->where('class_room_id', $date->class_room_id)
            ->where('date_event', strtotime($date['date_event']))
            ->exists();
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getAllWithPaginate($perPage)
    {
        $columns = ['id', 'date_event', 'group_id', 'subject_id', 'user_id', 'class_room_id'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(['Subject:id,name', 'User:id,surname', 'ClassRooms:id,name', 'Groups:id,name'])
            ->paginate($perPage);


        return $result;
    }

    public function ShowTable($table, $id)
    {

        $columns = ['id', 'date_event', 'class_room_id', 'subject_id', 'group_id', 'user_id'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->where($table, $id)
            ->toBase()
            ->get();

        // dd($table, $id, $result);
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

    public function upDate($ed_lesson, $request)
    {
        $date = $request->all();
        $date['date_event'] = strtotime($request['date_event']);
        $result = $ed_lesson
            ->fill($date)
            ->save();
        return $result;
    }

    public function lessonCreated($request)
    {
        $request['date_event'] = strtotime($request['date_event']);
        $lesson = $request->input();
        //dd($lesson);

        // dd($request, $lesson);
        $result = $this->startConditions()
            ->create($lesson);
        return $result;

    }
}

