<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $guarded = ['_token','_method'];
    const StatusOptions = [0=>'关闭',1=>'开启'];
    
}
