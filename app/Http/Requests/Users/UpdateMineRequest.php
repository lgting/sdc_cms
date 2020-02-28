<?php

namespace App\Http\Requests\Users;

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
        $rules =  [
            'nickname'=>'required|min:3|max:120',
        ];
        if ($this->input('password')){
            $rules['password'] = 'max:120|min:3';
        }
        return $rules;
    }

    public function messages(){
        return [
            'nickname.required' => trans('nickname required'),
            'nickname.min' => trans('users.nickname min'),
            'nickname.max' => trans('users.nickname max'),
            'password.max' => trans('users.password max'),
            'password.min' => trans('users.password min'),
        ];
    }
}
