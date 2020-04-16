<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|min:3|max:50',
            'excerpt' => 'nullable|string|max:150',
            'img' => 'nullable|image',
            'content' => 'required|string',
            'slug' => 'string|nullable',
            'categories_id' => 'required|integer|exists:news_categories,id',
            'is_published' => 'boolean'
        ];
    }
}
