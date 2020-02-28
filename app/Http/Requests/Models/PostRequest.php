<?php

namespace App\Http\Requests\Models;

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
            'name' => 'required',
            'table_name'=>'required|unique:models'
        ];
    }

    public function messages(){
        return [
            'name.required' => __('models.name required'),
            'table_name.required'=>__('models.table required'),
            'table_name.unique'=>__('models.table unique'),
        ];
    }
}
