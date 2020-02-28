<?php

namespace App\Http\Requests\Roles;

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
            'name'=>'required|min:2|max:30|unique:roles',
        ];
    }

    public function messages(){
        return [
            'name.required'=>trans('roles.name required'),
            'name.min'=>trans('roles.name min'),
            'name.max'=>trans('roles.name max'),
            'name.unique'=>trans('roles.name unique'),
        ];
    }
}
