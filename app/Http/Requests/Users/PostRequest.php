<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name'=>'required|min:3|max:120|unique:users',
            'nickname'=>'required|min:3|max:120',
            'password'=>'required|min:3'
        ];
    }

    public function messages(){
        return [
            'name.required'=>trans('users.name required'),
            'name.min'=>trans('users.name min'),
            'name.max'=>trans('users.name max'),
            'name.unique'=>trans('users.name unique'),
            'nickname.required'=>trans('users.nickname required'),
            'nickname.min'=>trans('users.nickname min'),
            'nickname.max'=>trans('users.nickname max'),
            'password.required'=>trans('users.password required'),
        ];
    }
}
