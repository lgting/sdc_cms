<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleUnique implements Rule
{
    protected $validate = null;
    protected $model = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($validate,$model = null)
    {
        $this->validate = $validate;
        $this->model = $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! is_null($this->model)){
            if($this->validate->name == $this->model->name)
                return true;
            return ! Role::where($attribute,$value)->exists();
        }else{
            return ! Role::where($attribute,$value)->exists();
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('roles.name unique');
    }
}
