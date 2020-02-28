<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Field;

class FieldUnique implements Rule
{
    protected $validate;
    protected $model;
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
        if (! is_null($this->model)){
            if($this->validate->en_name == $this->model->en_name){
                return true;
            }
            return ! Field::where([$attribute=>$value,'model_id'=>$this->validate->model_id])->exists();
        }else{
            return ! Field::where([$attribute=>$value,'model_id'=>$this->validate->model_id])->exists();
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('fields.can not unique');
    }
}
