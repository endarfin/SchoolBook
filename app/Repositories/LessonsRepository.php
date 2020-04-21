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
        return $this->startConditions()
            ->where('group_id', $date->group_id)
            ->where('subject_id', $date->subject_id)
            ->where('user_id', $date->user_id)
            ->where('class_room_id', $date->class_room_id)
            ->where('date_event', $date['date_event'])
            ->where('lesson', $date['lesson'])
            ->exists();
    }

    public function freeTeacherTime($date)
    {
        $result = $this->startConditions()
            ->where('user_id', $date->user_id)
            ->where('lesson', $date->lesson)
            ->where('date_event', $date->date_event)
            ->exists();

        return $result;
    }

    public function freeGroupTime($date)
    {
        $result = $this->startConditions()
            ->where('group_id', $date->group_id)
            ->where('lesson', $date->lesson)
            ->where('date_event', $date->date_event)
            ->exists();

        return $result;
    }
    public function freeClassRoomTime($date)
    {
        $result = $this->startConditions()
            ->where('class_room_id', $date->class_room_id)
            ->where('lesson', $date->lesson)
            ->where('date_event', $date->date_event)
            ->exists();

        return $result;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
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

    public function getPeriod($group_id, $subject_id, $periodBegin, $periodEnd)
    {
        $result = \DB::table('lessons')
            ->select('date_event', 'lesson')
            ->where([['group_id', '=', $group_id], ['subject_id', '=', $subject_id]])
            ->whereBetween('date_event', [$periodBegin, $periodEnd])
            ->orderBy('date_event')
            ->orderBy('lesson')
            ->get();
        return $result;
    }

    public function getStudentsDateMarks($group_id, $subject_id, $periodBegin, $periodEnd)
    {
        $result = \DB::table('lessons')
            ->join('groups', 'lessons.group_id', '=', 'groups.id')
            ->join('users', 'users.group_id', '=', 'groups.id')
            ->join('subjects', 'lessons.subject_id', '=', 'subjects.id')
            ->leftJoin('journals', function ($join) {
                $join->on('lessons.id', '=', 'journals.lessons_id');
                $join->on('journals.student_id', '=', 'users.id');
            })
            ->select('lessons.date_event as date', 'lessons.lesson as lesson', 'users.login as user', 'journals.mark as mark')
            ->where([['lessons.group_id', '=', $group_id], ['lessons.subject_id', '=', $subject_id]])
            ->whereBetween('date_event', [$periodBegin, $periodEnd])
            ->get();
        return $result;
    }

    public function getLessonId($data, $date)
    {
       $result = $this->startConditions()
            ->select('id')
            ->where('group_id', $data->group_id)
            ->where('subject_id', $data->subject_id)
            ->where('lesson', $data['number'])
            ->where('date_event', $date)
            ->pluck('id')
            ->first();
        return $result;
    }


}

