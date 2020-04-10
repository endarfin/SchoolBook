<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'phone'  =>  'required|regex:/^[0-9\-\+]{9,15}$/|unique:users',
            'email'  =>  'required|email|unique:users',
            'login'  =>  'required|string|min:3|max:20|unique:users',
            'password'  =>  'required|string|min:8',
            'type_user_id' => 'required|integer',
            'group_id' => 'sometimes|required',

        ];
    }
}
