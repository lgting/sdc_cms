<?php

namespace App\Http\Requests\Permissions;

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
            'name'=>'required|max:30|min:2|unique:permissions',
        ];
    }

    public function messages(){
        return [
            'name.required' => trans('permissions.name required'),
            'name.min' => trans('permissions.name min'),
            'name.max' => trans('permissions.name max'),
            'name.unique' => trans('permissions.name unique'),
        ];
    }
}
