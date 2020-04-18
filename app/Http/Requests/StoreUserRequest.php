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
            'name' => 'required|string|min:2|max:20',
            'surname' => 'required|string|min:3|max:20',
            'phone' => 'required|regex:/^[0-9\-\+]{9,15}$/|unique:users',
            'email' => 'required|email|unique:users',
            'login' => 'required|string|min:3|max:20|unique:users',
            'password' => 'required|string|min:8',
            'type_user_id' => 'required|integer',
            'group_id' => 'nullable',
            'subjects'=> 'nullable|array',

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $type = $this->type_user_id;
            if ((empty($this->group_id)) && ($type == 1))  {
                $validator->errors()->add('group', 'Group must be filled out for Students');
            }
            elseif ((!empty($this->group_id)) && ($type > 1))  {
                $validator->errors()->add('group', 'Group must be empty for Teachers and Admins');
            }
        });
        $validator->after(function ($validator) {
            $type = $this->type_user_id;
            if((!empty($this->subjects[0])) && ($type != 2))  {
                $validator->errors()->add('subject', 'Admins and Students dont have subjects');
            }
            elseif((empty($this->subjects[0])) && ($type == 2))  {
                $validator->errors()->add('subject', 'Teachers must have subjects');
            }

        });
    }

}
