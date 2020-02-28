<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RoleUnique;

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
            'name'=>['required','min:2','max:30',new RoleUnique($this,$this->route('role'))],
        ];
    }

    public function messages(){
        return [
            'name.required'=>trans('roles.name required'),
            'name.min'=>trans('roles.name min'),
            'name.max'=>trans('roles.name max'),
        ];
    }
}
