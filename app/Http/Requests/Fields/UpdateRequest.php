<?php

namespace App\Http\Requests\Fields;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FieldUnique;

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
            'zh_name'=>'required|min:2',
            'en_name'=>['required','min:2',new FieldUnique($this,$this->route('field'))],
            'type'=>'required',
            'model_id'=>'required'
        ];
    }

    public function messages(){
        return [
            'zh_name.required'=> trans('fields.zh name required'),
            'zh_name.min'=> trans('fields.zh name min'),
            'en_name.required'=> trans('fields.en name required'),
            'en_name.min'=> trans('fields.en name min'),
            'type.required'=> trans('fields.type required'),
            'model_id.required'=> trans('fields.model id required'),
        ];
    }
}
