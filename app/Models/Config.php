<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $guarded = ['_token','_method'];
    
    const DataTypeOptions = [0=>'输入框',1=>'单选按钮',2=>'复选框',3=>'下拉菜单',4=>'文本域',5=>'附件'];

    const ConfigTypeOptions = [0=>'基本信息',1=>'联系方式',2=>'SEO设置'];
}
