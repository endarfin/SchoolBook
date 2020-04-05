<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name'  =>  'required|string|min:2|max:20',
            'surname'  =>  'required|string|min:3|max:20',
            'phone'  =>  'required|regex:/(01)[0-9]{10}/',
            'email'  =>  'required|email',
            'type_user_id' => 'required',
            'group_id' => 'required',
            'login' => 'required|string|min:2|max:20',
            'password' => 'required|min:8',

        ];
    }
}
