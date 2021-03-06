<?php

namespace App\Http\Requests\Menus;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title'=>'required',
            'uri'=>'required',
            'sortable'=>'integer',
        ];
    }

    public function messages(){
        return [
            'title.required' => trans('menus.title required'),
            'uri.required' => trans('menus.uri required'),
            'sortable.integer' => trans('menus.sortable integer'),
        ];
    }
}
