<?php

namespace App\Repositories;

use App\Models\Lessons as Model;

/**
 * Class LessonsRepository
 * @package App\Repositories
 */
class LessonsRepository extends CoreRepository
{
    /**
     * @param int $id
     * @return Model
     */
    public function exist($date)
    {
        //dd($date->group_id);
        $result = $this->startConditions()
            ->where([['group_id', $date->group_id], ['subject_id', $date->subject_id],
                ['user_id', $date->user_id], ['class_room_id', $date->class_room_id],
                ['date_event', $date['date_event']], ['lesson', $date['lesson']]])
            ->exists();
        if ($result){
            return false;
        }else{return true;}
    }

    public function freeTeacherTime($date)
    {
        $result = $this->startConditions()
            ->where([['user_id', $date->user_id], ['lesson', $date->lesson],
                    ['date_event', $date->date_event]])
            ->exists();

        if ($result){
            return false;
        }else{return true;}
    }

    public function freeGroupTime($date)
    {
        $result = $this->startConditions()
            ->where([['group_id', $date->group_id], ['lesson', $date->lesson],
                ['date_event', $date->date_event]])
            ->exists();
        if ($result){
            return false;
        }else{return true;}
    }
    public function freeClassRoomTime($date)
    {
        $result = $this->startConditions()
            ->where([['class_room_id', $date->class_room_id], ['lesson', $date->lesson],
                ['date_event', $date->date_event]])
            ->exists();

        if ($result){
            return false;
        }else{return true;}
    }

    public function getEdit($id)
    {
        return $this->startConditions()
            ->with(['Subject:id,name', 'User:id,name,surname', 'ClassRooms:id,name', 'Groups:id,name', 'TimeLessons:id,time'])
            ->find($id);
    }

    public function getAllWithPaginate($perPage)
    {
        $columns = ['id', 'date_event', 'group_id', 'subject_id', 'user_id', 'class_room_id', 'lesson'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(['Subject:id,name', 'User:id,surname', 'ClassRooms:id,name', 'Groups:id,name', 'TimeLessons:id,time'])
            ->paginate($perPage);


        return $result;
    }

    public function ShowTable($table, $id)
    {

        $columns = ['id', 'date_event', 'class_room_id', 'subject_id', 'group_id', 'user_id', 'lesson'];
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
        $result = $ed_lesson
            ->fill($date)
            ->save();
        return $result;
    }

    public function lessonCreated($request)
    {
        $lesson = $request->input();
        $result = $this->startConditions()
            ->create($lesson);
        return $result;

    }
}

