<?php

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PermissionUnique;

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
            'name' => ['required','min:2','max:30',new PermissionUnique($this,$this->route('permission'))],
        ];
    }

    public function messages(){
        return [
            'name.required' => trans('permissions.name required'),
            'name.min' => trans('permissions.name min'),
            'name.max' => trans('permissions.name max'),
        ];
    }
}
