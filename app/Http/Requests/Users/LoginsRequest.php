<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class LoginsRequest extends FormRequest
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
            'name'=>'required|max:120|min:2',
            'password'=>'required|min:3|max:120'
        ];
    }

    public function messages(){
        return [
            'name.required'=>trans('users.name required'),
            'name.max'=>trans('users.name max'),
            'name.min'=>trans('users.name min'),
            'password.required'=>trans('users.name required'),
            'password.max'=>trans('users.password max'),
            'password.min'=>trans('users.password min'),
        ];
    }
}
