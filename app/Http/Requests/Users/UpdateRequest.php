<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UserUnique;
use App\Models\User;

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
            'name'=>['required','min:3','max:120',new UserUnique($this,$this->route('user'))],
        ];
        if ($this->input('password')){
            $rules['password'] = 'max:120|min:3';
        }
        return $rules;
    }

    public function messages(){
        return [
            'name.required' => trans('user.name required'),
            'name.min' => trans('users.name min'),
            'name.max' => trans('users.name max'),
            'name.required' => trans('users.nickname required'),
            'nickname.min' => trans('users.nickname min'),
            'nickname.max' => trans('users.nickname max'),
            'password.max' => trans('users.password max'),
            'password.min' => trans('users.password min'),
        ];
    }
}
