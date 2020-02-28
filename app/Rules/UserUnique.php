<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class UserUnique implements Rule
{
    protected $validate = null;
    protected $model = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($validate,$model=null)
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
        if(! is_null($this->model)){
            if ($this->validate->name == $this->model->name)
                return true;
            return ! User::where($attribute,$value)->exists();
        }else{
            return ! User::where($attribute,$value)->exists();
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('users.name unique');
    }
}
