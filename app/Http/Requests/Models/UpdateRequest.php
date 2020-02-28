<?php

namespace App\Http\Requests\Models;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $tableName = $this->route('model')->table_name;
        return [
            'name' => 'required',
            'table_name'=>[
                'required',
                Rule::unique('models')->ignore($tableName, 'table_name')
            ]
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
