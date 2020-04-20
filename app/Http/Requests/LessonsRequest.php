<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return auth()->check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group_id' => 'required|integer|exists:groups,id',
            'subject_id' => 'required|integer|exists:subjects,id',
            'user_id' => 'required|integer|exists:teacher_subject,user_id',
            'class_room_id' => 'required|integer|exists:class_rooms,id',
            'date_event' => 'required|date',
            'lesson' => 'required|integer|exists:time_lessons,id',
        ];
    }
}
