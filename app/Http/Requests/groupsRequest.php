<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class groupsRequest extends FormRequest
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
            'name' => 'required|min:3|max:20',
            'course_id' => 'required|integer|exists:courses,id',
        ];
    }
}
